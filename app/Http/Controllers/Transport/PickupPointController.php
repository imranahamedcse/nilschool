<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transport\PickupPoint\StoreRequest;
use App\Http\Requests\Transport\PickupPoint\UpdateRequest;
use App\Http\Interfaces\Transport\PickupPointInterface;
use Illuminate\Support\Facades\Schema;

class PickupPointController extends Controller
{
    private $repo;

    function __construct(PickupPointInterface $repo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->repo       = $repo; 
    }

    public function index()
    {
        $data['pickup_point'] = $this->repo->getAll();

        $title             = ___('account.Pickup Point');
        $data['headers']   = [
            "title"        => $title,
            "create-permission" => 'pickup_point_create',
            "create-route" => 'pickup-point.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.transport.pickup_point.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('account.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Pickup Point'), "route" => "pickup-point.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.transport.pickup_point.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('pickup-point.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('account.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Pickup Point'), "route" => "pickup-point.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        
        $data['pickup_point']        = $this->repo->show($id);
        return view('backend.admin.transport.pickup_point.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('pickup-point.index')->with('success', $result['message']);
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

