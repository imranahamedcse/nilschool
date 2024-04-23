<?php

namespace App\Http\Repositories\Canteen;

use App\Http\Interfaces\Canteen\OrderInterface;
use App\Models\Canteen\Book;
use App\Models\Canteen\Order;
use App\Models\Canteen\OrderItems;
use App\Models\Canteen\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;
use Carbon\Carbon;

class OrderRepository implements OrderInterface
{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->active()->get();
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function store($request)
    {
        // DB::beginTransaction();
        // try {

            $products = Product::findMany($request->ids);
            $total_price = 0;
            foreach ($products as $key => $product) {
                $quantity = $request->quantities[$key] ?? 1;
                $total_price += $product->price * $quantity;
            }

            $total_quantity = array_sum($request->quantities);

            $row                      = new $this->model;
            $row->total_quantity      = $total_quantity;
            $row->total_price         = $total_price;
            $row->discount_type       = $request->discount_type;
            $row->amount              = $request->amount;
            $row->note                = $request->note;
            $row->save();

            $row->invoice_no = $row->id;
            $row->save();

            foreach ($request->ids as $key => $id) {
                $order = new OrderItems();
                $order->order_id = $row->id;
                $order->product_id = $id;
                $order->quantity = $request->quantities[$key];
                $order->save();
            }

            // DB::commit();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        // }
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->model->findOrfail($id);
            $row->book_id          = $request->book;
            $row->user_id          = $request->member;
            $row->issue_date       = $request->issue_date;
            $row->return_date      = $request->return_date;
            $row->phone            = $request->phone;
            $row->description      = $request->description;
            $row->save();

            DB::commit();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $row = $this->model->find($id);
            $row->delete();

            DB::commit();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function getProducts($request)
    {
        return Product::where('name', 'like', '%' . $request->text . '%')->pluck('name', 'id')->take(10)->toArray();
    }

    public function searchResult($request)
    {
        return  $this->model::query()
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->whereHas('user', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->keyword . '%');
                    })->orWhereHas('product', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->keyword . '%');
                    });
                })
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%');

                if (strtotime($request->keyword)) {
                    $query->orWhere('issue_date', Carbon::parse($request->keyword)->format('Y-m-d'))
                        ->orWhere('return_date', Carbon::parse($request->keyword)->format('Y-m-d'));
                }
            })
            ->get();
    }
}
