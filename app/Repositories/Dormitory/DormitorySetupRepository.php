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
    private $head;

    public function __construct(DormitorySetup $head)
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
            DB::transaction(function () use ($request) {
                $row                   = new $this->head;
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
        return $this->head->find($id);
    }

    public function update($request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $row                   = $this->head->findOrfail($id);
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
            $headDestroy = $this->head->find($id);
            $headDestroy->delete();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
