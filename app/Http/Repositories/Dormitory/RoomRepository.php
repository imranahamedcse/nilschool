<?php

namespace App\Http\Repositories\Dormitory;

use App\Enums\Settings;
use App\Http\Interfaces\Dormitory\RoomInterface;
use App\Models\Dormitory\Room;
use App\Traits\ReturnFormatTrait;

class RoomRepository implements RoomInterface
{
    use ReturnFormatTrait;
    private $model;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->active()->orderBy('name')->get();
    }
    public function getAll()
    {
        return $this->model->latest()->get();
    }

    public function store($request)
    {
        try {
            $row                   = new $this->model;
            $row->room_type_id     = $request->type;
            $row->room_no          = $request->room_no;
            $row->status           = $request->status;
            $row->description      = $request->description;
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
            $row                   = $this->model->findOrfail($id);
            $row->room_type_id     = $request->type;
            $row->room_no          = $request->room_no;
            $row->status           = $request->status;
            $row->description      = $request->description;
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

    public function getRoom($id)
    {
        return $this->model->where('id', $id)->with('type')->first();
    }
}
