<?php

namespace App\Http\Repositories\Academic;

use App\Enums\Settings;
use App\Http\Interfaces\Academic\ShiftInterface;
use App\Models\Academic\Shift;
use App\Traits\ReturnFormatTrait;

class ShiftRepository implements ShiftInterface
{
    use ReturnFormatTrait;
    private $model;

    public function __construct(Shift $model)
    {
        $this->model = $model;
    }

    public function allActive()
    {
        return $this->model->active()->get();
    }

    public function all()
    {
        return $this->model->latest()->get();
    }

    public function store($request)
    {
        try {
            $row              = new $this->model;
            $row->name        = $request->name;
            $row->status      = $request->status;
            $row->save();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update($request, $id)
    {
        try {
            $row              = $this->model->findOrfail($id);
            $row->name        = $request->name;
            $row->status      = $request->status;
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
}
