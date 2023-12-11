<?php

namespace App\Repositories\Dormitory;

use App\Enums\Settings;
use App\Interfaces\Dormitory\DormitorySetupInterface;
use App\Models\Dormitory\DormitorySetup;
use App\Models\Dormitory\DormitorySetupChild;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;

class DormitorySetupRepository implements DormitorySetupInterface
{
    use ReturnFormatTrait;
    private $model;

    public function __construct(DormitorySetup $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->active()->orderBy('name')->get();
    }
    public function getAll()
    {
        return $this->model->latest()->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $row                   = new $this->model;
                $row->dormitory_id     = $request->dormitory_id;
                $row->status           = $request->status;
                $row->save();

                foreach ($request->room as $key => $value) {
                    $room = new DormitorySetupChild();
                    $room->dormitory_setup_id = $row->id;
                    $room->room_id = (int)$value;
                    $room->save();
                }
            });
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
            DB::transaction(function () use ($request, $id) {
                $row                   = $this->model->findOrfail($id);
                $row->dormitory_id     = $request->dormitory_id;
                $row->status           = $request->status;
                $row->save();

                DormitorySetupChild::where('dormitory_setup_id', $row->id)->delete();
                foreach ($request->room as $key => $value) {
                    $room = new DormitorySetupChild();
                    $room->dormitory_setup_id = $row->id;
                    $room->room_id = (int)$value;
                    $room->save();
                }
            });

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

    public function getRoom($id){
        $data = $this->model->where('dormitory_id', $id)->first();
        return $data->rooms;
    }

    public function getDormitoryRoom($id)
    {
        return $this->model->where('dormitory_id', $id)->with('rooms', 'rooms.room')->first();
    }
}
