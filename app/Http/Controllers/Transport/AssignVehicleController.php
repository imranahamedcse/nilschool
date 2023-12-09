<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transport\AssignVehicle\StoreRequest;
use App\Http\Requests\Transport\AssignVehicle\UpdateRequest;
use App\Interfaces\Transport\AssignVehicleInterface;
use App\Interfaces\Transport\PickupPointInterface;
use App\Interfaces\Transport\RouteInterface;
use App\Interfaces\Transport\VehicleInterface;
use Illuminate\Support\Facades\Schema;

class AssignVehicleController extends Controller
{
    private $repo, $pickupPointRepo, $routeRepo, $vehicleRepo;

    function __construct(
        AssignVehicleInterface $repo,
        PickupPointInterface $pickupPointRepo,
        RouteInterface $routeRepo,
        VehicleInterface $vehicleRepo
    )
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->repo            = $repo; 
        $this->pickupPointRepo = $pickupPointRepo; 
        $this->routeRepo       = $routeRepo; 
        $this->vehicleRepo     = $vehicleRepo; 
    }

    public function index()
    {
        $data['assign_vehicle'] = $this->repo->getAll();
        $title             = ___('account.Assign vehicle');
        $data['headers']   = [
            "title"        => $title,
            "create-permission" => 'assign_vehicle_create',
            "create-route" => 'assign-vehicle.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.transport.assign_vehicle.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('account.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Assign vehicle'), "route" => "assign-vehicle.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['pickup_point'] = $this->pickupPointRepo->getAll();
        $data['route'] = $this->routeRepo->getAll();
        $data['vehicle'] = $this->vehicleRepo->getAll();

        return view('backend.admin.transport.assign_vehicle.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('assign-vehicle.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('account.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Assign vehicle'), "route" => "assign-vehicle.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        
        $data['pickup_point'] = $this->pickupPointRepo->getAll();
        $data['route'] = $this->routeRepo->getAll();
        $data['vehicle'] = $this->vehicleRepo->getAll();
        
        $data['assign_vehicle'] = $this->repo->show($id);
        $data['assign_pickup_point'] = array_unique($data['assign_vehicle']->pickupPoints->pluck('pickup_point_id')->toArray());
        $data['assign_vehicles'] = array_unique($data['assign_vehicle']->vehicles->pluck('vehicle_id')->toArray());

        return view('backend.admin.transport.assign_vehicle.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('assign-vehicle.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->repo->destroy($id);
        if($result['status']):
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else:
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;     
    }
}

