<?php

namespace App\Http\Repositories\Transport;

use App\Enums\Settings;
use App\Http\Interfaces\Transport\TransportStudentInterface;
use App\Models\Transport\TransportStudent;
use App\Traits\ReturnFormatTrait;

class TransportStudentRepository implements TransportStudentInterface
{
    use ReturnFormatTrait;
    private $model;

    public function __construct(TransportStudent $model)
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
            $row                    = new $this->model;
            $row->class_id          = $request->class;
            $row->section_id        = $request->section;
            $row->student_id        = $request->student;
            $row->route_id          = $request->route_id;
            $row->vehicle_id        = $request->vehicle;
            $row->pickup_point_id   = $request->pickup_point;
            $row->note              = $request->note;
            $row->status            = $request->status;
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
            $row                    = $this->model->findOrfail($id);
            $row->class_id          = $request->class;
            $row->section_id        = $request->section;
            $row->student_id        = $request->student;
            $row->route_id          = $request->route_id;
            $row->vehicle_id        = $request->vehicle;
            $row->pickup_point_id   = $request->pickup_point;
            $row->note              = $request->note;
            $row->status            = $request->status;
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
