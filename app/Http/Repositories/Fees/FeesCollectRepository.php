<?php

namespace App\Http\Repositories\Fees;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Accounts\Income;
use App\Models\Fees\FeesCollect;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Fees\FeesAssignChildren;
use App\Http\Interfaces\Fees\FeesMasterInterface;
use App\Http\Interfaces\Fees\FeesCollectInterface;
use App\Models\StudentInfo\SessionClassStudent;

class FeesCollectRepository implements FeesCollectInterface
{
    use ReturnFormatTrait;

    private $model;
    private $feesMasterRepo;

    public function __construct(FeesCollect $model, FeesMasterInterface $feesMasterRepo)
    {
        $this->model          = $model;
        $this->feesMasterRepo = $feesMasterRepo;
    }

    public function allActive()
    {
        return $this->model->active()->get();
    }

    public function all()
    {
        return $this->model::latest()->get();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->fees_assign_childrens as $key => $item) {


                $row                   = new $this->model;
                $row->date             = $request->date;
                $row->payment_method   = $request->payment_method;
                $row->fees_assign_children_id   = $item;
                $row->amount           = $request->amounts[$key] + $request->fine_amounts[$key] ?? 0;
                $row->fine_amount      = $request->fine_amounts[$key];
                $row->fees_collect_by  = Auth::user()->id;
                $row->student_id       = $request->student_id;
                $row->session_id       = setting('session');
                $row->save();

                $incomeStore                   = new Income();
                $incomeStore->fees_collect_id  = $row->id;
                $incomeStore->name             = $item;
                $incomeStore->session_id       = setting('session');
                $incomeStore->income_head      = 1; // Because, Fees id 1.
                $incomeStore->date             = $request->date;
                $incomeStore->amount           = $row->amount;
                $incomeStore->save();
            }
            DB::commit();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function feesAssigned($id) // student id
    {
        $groups = FeesAssignChildren::withCount('feesCollect')->with('feesCollect')->where('student_id', $id);

        $groups = $groups->whereHas('feesAssign', function ($query) {
            return $query->where('session_id', setting('session'));
        });

        return $groups->get();
    }

    public function update($request, $id)
    {
        try {
            $row                = $this->model->findOrfail($id);
            $row->name          = $request->name;
            $row->code          = $request->code;
            $row->description   = $request->description;
            $row->status        = $request->status;
            $row->save();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        try {
            $row = $this->model->find($id);
            $row->delete();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function getFeesAssignStudents($request)
    {
        $students = SessionClassStudent::query();
        $students = $students->where('session_id', setting('session'));
        if ($request->class != "") {

            $students = $students->where('classes_id', $request->class);
        }

        if ($request->section != "") {

            $students = $students->where('section_id', $request->section);
        }

        return $students->paginate(10);
    }

    public function feesShow($request)
    {
        $data['fees_assign_children'] = $this->feesAssigned($request->student_id)->whereIn('id', $request->fees_assign_childrens);

        $data['student_id']           = $request->student_id;
        return $data;
    }





    public function payWithStripeStore($request)
    {
        DB::transaction(function () use ($request) {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $feesAssignChildren = optional(FeesAssignChildren::with('feesMaster')->where('id', $request->fees_assign_children_id)->first());
            $description = 'Pay ' . ($request->amount + $request->fine_amount) . ' for ' . $feesAssignChildren->feesMaster?->type?->name . ' fee by ' . auth()->user()->name;

            $charge = Charge::create([
                "amount"        => ($request->amount + $request->fine_amount) * 100,
                "currency"      => "usd",
                "source"        => $request->stripeToken,
                "description"   => $description
            ]);

            $this->feeCollectStoreByStripe($request, @$charge->balance_transaction);
        });
    }





    protected function feeCollectStoreByStripe($request, $transaction_id)
    {
        $feesCollect = FeesCollect::create([
            'date'                      => $request->date,
            'payment_method'            => 2,
            'payment_gateway'           => 'Stripe',
            'transaction_id'            => $transaction_id,
            'fees_assign_children_id'   => $request->fees_assign_children_id,
            'amount'                    => $request->amount + $request->fine_amount ?? 0,
            'fine_amount'               => $request->fine_amount,
            'fees_collect_by'           => auth()->id(),
            'student_id'                => $request->student_id,
            'session_id'                => setting('session')
        ]);

        Income::create([
            'fees_collect_id'           => $feesCollect->id,
            'name'                      => $request->fees_assign_children_id,
            'session_id'                => setting('session'),
            'income_head'               => 1, // Because, Fees id 1.
            'date'                      => $request->date,
            'amount'                    => $feesCollect->amount
        ]);
    }




    public function paypalOrderData($invoice_no, $success_route, $cancel_route)
    {
        $feesAssignChildren = optional(FeesAssignChildren::with('feesMaster')->where('id', session()->get('FeesAssignChildrenID'))->first());

        $total = $feesAssignChildren->feesMaster?->amount;
        if (date('Y-m-d') > $feesAssignChildren->feesMaster?->due_date && $feesAssignChildren->fees_collect_count == 0) {
            $total += $feesAssignChildren->feesMaster?->fine_amount;
        }

        $description = 'Pay ' . $total . ' for ' . $feesAssignChildren->feesMaster?->type?->name . ' fee by ' . auth()->user()->name;

        $data                           = [];
        $data['items']                  = [];
        $data['invoice_id']             = $invoice_no;
        $data['invoice_description']    = $description;
        $data['return_url']             = $success_route;
        $data['cancel_url']             = $cancel_route;
        $data['total']                  = $total;

        return $data;
    }





    public function feeCollectStoreByPaypal($response, $feesAssignChildren)
    {
        DB::transaction(function () use ($response, $feesAssignChildren) {

            $amount = $feesAssignChildren->feesMaster?->amount;
            $fine_amount = 0;

            if (date('Y-m-d') > $feesAssignChildren->feesMaster?->due_date && $feesAssignChildren->fees_collect_count == 0) {
                $fine_amount = $feesAssignChildren->feesMaster?->fine_amount;
                $amount += $fine_amount;
            }

            $date = date('Y-m-d', strtotime($response['PAYMENTINFO_0_ORDERTIME']));

            $feesCollect = FeesCollect::create([
                'date'                      => $date,
                'payment_method'            => 2,
                'payment_gateway'           => 'Paypal',
                'transaction_id'            => $response['PAYMENTINFO_0_TRANSACTIONID'],
                'fees_assign_children_id'   => $feesAssignChildren->id,
                'amount'                    => $amount,
                'fine_amount'               => $fine_amount,
                'fees_collect_by'           => auth()->id(),
                'student_id'                => $feesAssignChildren->student_id,
                'session_id'                => setting('session')
            ]);

            Income::create([
                'fees_collect_id'           => $feesCollect->id,
                'name'                      => $feesAssignChildren->id,
                'session_id'                => setting('session'),
                'income_head'               => 1, // Because, Fees id 1.
                'date'                      => $date,
                'amount'                    => $amount
            ]);
        });
    }
}
