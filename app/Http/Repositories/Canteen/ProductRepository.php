<?php

namespace App\Http\Repositories\Canteen;

use App\Http\Interfaces\Canteen\ProductInterface;
use App\Models\Canteen\Product;
use Illuminate\Support\Facades\DB;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;

class ProductRepository implements ProductInterface
{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $model;

    public function __construct(Product $model)
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
        DB::beginTransaction();
        try {
            $row                   = new $this->model;
            $row->name             = $request->name;
            $row->product_categorie_id = $request->category;
            $row->sku              = $request->sku;
            $row->price            = $request->price;
            $row->quantity         = $request->quantity;
            $row->status           = $request->status;
            $row->description      = $request->description;
            $row->save();

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

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->model->findOrfail($id);
            $row->name             = $request->name;
            $row->product_categorie_id = $request->category;
            $row->sku              = $request->sku;
            $row->price            = $request->price;
            $row->quantity         = $request->quantity;
            $row->status           = $request->status;
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
}
