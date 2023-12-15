<?php

namespace App\Http\Repositories\Academic;

use App\Enums\Settings;
use App\Http\Interfaces\Academic\TimeScheduleInterface;
use App\Models\Academic\TimeSchedule;
use App\Traits\ReturnFormatTrait;

class TimeScheduleRepository implements TimeScheduleInterface
{
    use ReturnFormatTrait;
    private $time, $model;

    public function __construct(TimeSchedule $model)
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

    public function allClassSchedule()
    {
        return $this->model->active()->where('type', 1)->get();
    }
    public function allExamSchedule()
    {
        return $this->model->active()->where('type', 2)->get();
    }

    public function store($request)
    {
        try {
            $result = $this->model->where('type', $request->type)->get();

            foreach ($result as $key => $value) {
                if($value->start_time <= $request->start_time && $request->start_time <= $value->end_time || $value->start_time <= $request->end_time && $request->end_time <= $value->end_time) {
                    return $this->responseWithError(___('alert.Already assigned.'), []);
                }
            }

            $row              = new $this->model;
            $row->type        = $request->type;
            $row->status      = $request->status;
            $row->start_time  = $request->start_time;
            $row->end_time    = $request->end_time;
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
            $result = $this->model->where('type', $request->type)->get();

            foreach ($result as $key => $value) {
                if($value->start_time <= $request->start_time && $request->start_time <= $value->end_time && $value->id != $id || $value->start_time <= $request->end_time && $request->end_time <= $value->end_time && $value->id != $id) {
                    return $this->responseWithError(___('alert.Already assigned.'), []);
                }
            }

            $row              = $this->model->findOrfail($id);
            $row->type        = $request->type;
            $row->status      = $request->status;
            $row->start_time  = $request->start_time;
            $row->end_time    = $request->end_time;
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
