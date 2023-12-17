<?php

namespace App\Http\Controllers\StudentPanel;

use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Models\Accounts\Income;
use App\Models\Fees\FeesCollect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Fees\FeesAssignChildren;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Repositories\Fees\FeesCollectRepository;
use App\Http\Repositories\StudentPanel\FeesRepository;

class FeesController extends Controller
{
    private $repo;
    private $feesCollectRepository;

    function __construct(FeesRepository $repo, FeesCollectRepository $feesCollectRepository)
    {
        $this->repo = $repo;
        $this->feesCollectRepository = $feesCollectRepository;
    }


    public function index()
    {
        $data = $this->repo->index();
        return view('backend.student.fees', compact('data'));
    }


    public function payModal(Request $request)
    {
        return view('backend.student.pay-modal', [
            'feeAssignChildren' => FeesAssignChildren::with('feesMaster')->where('id', $request->fees_assigned_children_id)->first()
        ]);
    }


    public function payWithStripe(Request $request)
    {
        try {
            $this->feesCollectRepository->payWithStripeStore($request);

            return back()->with('success', ___('alert.Fee has been paid successfully'));

        } catch (\Throwable $th) {
            return back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
        }
    }





    public function payWithPaypal(Request $request)
    {
        Session::put('FeesAssignChildrenID', $request->fees_assign_children_id);

        $provider   = new ExpressCheckout;
        $data       = $this->feesCollectRepository->paypalOrderData(uniqid(), route('student-panel-fees.payment.success'), route('student-panel-fees.payment.cancel'));
        $response   = $provider->setExpressCheckout($data);

        return redirect($response['paypal_link']);
    }





    public function paymentSuccess(Request $request)
    {
        try {
            $provider   = new ExpressCheckout;
            $token      = $request->token;
            $PayerID    = $request->PayerID;
            $response   = $provider->getExpressCheckoutDetails($token);

            $invoiceID  = $response['INVNUM'] ?? uniqid();
            $data       = $this->feesCollectRepository->paypalOrderData($invoiceID, route('student-panel-fees.payment.success'), route('student-panel-fees.payment.cancel'));
            $response   = $provider->doExpressCheckoutPayment($data, $token, $PayerID);

            $feesAssignChildren = optional(FeesAssignChildren::with('feesMaster')->where('id', session()->get('FeesAssignChildrenID'))->first());

            if ($feesAssignChildren && $response['PAYMENTINFO_0_TRANSACTIONID']) {
                $this->feesCollectRepository->feeCollectStoreByPaypal($response, $feesAssignChildren);
            }

            session()->forget('FeesAssignChildrenID');

            return redirect()->route('student-panel-fees.index')->with('success', ___('alert.Fee has been paid successfully'));

        } catch (\Throwable $th) {

            return redirect()->route('student-panel-fees.index')->with('danger', ___('alert.something_went_wrong_please_try_again'));
        }
    }





    public function paymentCancel()
    {
        return redirect()->route('student-panel-fees.index')->with('danger', ___('alert.Payment cancelled!'));
    }
}
