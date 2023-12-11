<?php

namespace App\Repositories\Dormitory;

use App\Enums\Settings;
use App\Interfaces\Dormitory\DormitoryStudentInterface;
use App\Models\Dormitory\DormitoryStudent;
use App\Traits\ReturnFormatTrait;

class DormitoryStudentRepository implements DormitoryStudentInterface
{
    use ReturnFormatTrait;
    private $head;

    public function __construct(DormitoryStudent $head)
    {
        $this->head = $head;
    }

    public function all()
    {
        return $this->head->active()->orderBy('name')->get();
    }
    public function getAll()
    {
        return $this->head->latest()->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        try {
            $row                   = new $this->head;
            $row->name             = $request->name;
            $row->total_seat       = $request->total_seat;
            $row->seat_fee         = $request->seat_fee;
            $row->status           = $request->status;
            $row->save();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function show($id)
    {
        return $this->head->find($id);
    }

    public function update($request, $id)
    {
        try {
            $row                   = $this->head->findOrfail($id);
            $row->name             = $request->name;
            $row->total_seat       = $request->total_seat;
            $row->seat_fee         = $request->seat_fee;
            $row->status           = $request->status;
            $row->save();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        try {
            $headDestroy = $this->head->find($id);
            $headDestroy->delete();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
