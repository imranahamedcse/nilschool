<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transport\TransportSetup\StoreRequest;
use App\Http\Requests\Transport\TransportSetup\UpdateRequest;
use App\Http\Interfaces\Transport\TransportSetupInterface;
use App\Http\Interfaces\Transport\PickupPointInterface;
use App\Http\Interfaces\Transport\RouteInterface;
use App\Http\Interfaces\Transport\VehicleInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class TransportSetupController extends Controller
{
    private $repo, $pickupPointRepo, $routeRepo, $vehicleRepo;

    function __construct(
        TransportSetupInterface $repo,
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
        $data['transport_setup'] = $this->repo->getAll();
        $title             = ___('account.Transport setup');
        $data['headers']   = [
            "title"        => $title,
            "create-permission" => 'transport_setup_create',
            "create-route" => 'transport-setup.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.transport.transport_setup.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('account.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Transport setup'), "route" => "transport-setup.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['pickup_point'] = $this->pickupPointRepo->getAll();
        $data['route'] = $this->routeRepo->getAll();
        $data['vehicle'] = $this->vehicleRepo->getAll();

        return view('backend.admin.transport.transport_setup.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('transport-setup.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('account.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Transport setup'), "route" => "transport-setup.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['pickup_point'] = $this->pickupPointRepo->getAll();
        $data['route'] = $this->routeRepo->getAll();
        $data['vehicle'] = $this->vehicleRepo->getAll();

        $data['transport_setup'] = $this->repo->show($id);
        $data['assign_pickup_point'] = array_unique($data['transport_setup']->pickupPoints->pluck('pickup_point_id')->toArray());
        $data['transport_setups'] = array_unique($data['transport_setup']->vehicles->pluck('vehicle_id')->toArray());

        return view('backend.admin.transport.transport_setup.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('transport-setup.index')->with('success', $result['message']);
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

    public function getVehiclePickupPoint(Request $request){
        return $this->repo->getTransport($request->id);
    }
}

