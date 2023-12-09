<?php

namespace App\Repositories\Transport;

use App\Enums\Settings;
use App\Interfaces\Transport\AssignVehicleInterface;
use App\Models\Transport\AssignPickupPointChild;
use App\Models\Transport\AssignVehicle;
use App\Models\Transport\AssignVehicleChild;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;

class AssignVehicleRepository implements AssignVehicleInterface
{
    use ReturnFormatTrait;
    private $model;

    public function __construct(AssignVehicle $model)
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
                $row->route_id         = $request->route_id;
                $row->description      = $request->description;
                $row->status           = $request->status;
                $row->save();

                foreach ($request->vehicle as $key => $value) {
                    $vehicle = new AssignVehicleChild();
                    $vehicle->assign_vehicle_id = $row->id;
                    $vehicle->vehicle_id = (int)$value;
                    $vehicle->save();
                }

                foreach ($request->pickup_point as $key => $value) {
                    $pickup_point = new AssignPickupPointChild();
                    $pickup_point->assign_vehicle_id = $row->id;
                    $pickup_point->pickup_point_id = (int)$value;
                    $pickup_point->save();
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
                $row->route_id         = $request->route_id;
                $row->description      = $request->description;
                $row->status           = $request->status;
                $row->save();

                AssignVehicleChild::where('assign_vehicle_id', $row->id)->delete();
                foreach ($request->vehicle as $key => $value) {
                    $vehicle = new AssignVehicleChild();
                    $vehicle->assign_vehicle_id = $row->id;
                    $vehicle->vehicle_id = (int)$value;
                    $vehicle->save();
                }

                AssignPickupPointChild::where('assign_vehicle_id', $row->id)->delete();
                foreach ($request->pickup_point as $key => $value) {
                    $pickup_point = new AssignPickupPointChild();
                    $pickup_point->assign_vehicle_id = $row->id;
                    $pickup_point->pickup_point_id = (int)$value;
                    $pickup_point->save();
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
}
