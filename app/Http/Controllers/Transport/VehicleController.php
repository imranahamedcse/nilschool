<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transport\Vehicle\StoreRequest;
use App\Http\Requests\Transport\Vehicle\UpdateRequest;
use App\Interfaces\Transport\VehicleInterface;
use Illuminate\Support\Facades\Schema;

class VehicleController extends Controller
{
    private $headRepo;

    function __construct(VehicleInterface $headRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->headRepo       = $headRepo; 
    }

    public function index()
    {
        $data['vehicle'] = $this->headRepo->getAll();

        $title             = ___('account.Vehicle');
        $data['headers']   = [
            "title"        => $title,
            "create-permission" => 'vehicle_create',
            "create-route" => 'vehicle.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.transport.vehicle.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('account.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Vehicle'), "route" => "vehicle.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.transport.vehicle.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->headRepo->store($request);
        if($result['status']){
            return redirect()->route('vehicle.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('account.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Vehicle'), "route" => "vehicle.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        
        $data['vehicle']        = $this->headRepo->show($id);
        return view('backend.admin.transport.vehicle.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->headRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('vehicle.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->headRepo->destroy($id);
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

