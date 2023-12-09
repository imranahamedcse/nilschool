<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transport\PickupPoint\StoreRequest;
use App\Http\Requests\Transport\PickupPoint\UpdateRequest;
use App\Interfaces\Transport\PickupPointInterface;
use Illuminate\Support\Facades\Schema;

class PickupPointController extends Controller
{
    private $headRepo;

    function __construct(PickupPointInterface $headRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->headRepo       = $headRepo; 
    }

    public function index()
    {
        $data['pickup_point'] = $this->headRepo->getAll();

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
        $result = $this->headRepo->store($request);
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
        
        $data['pickup_point']        = $this->headRepo->show($id);
        return view('backend.admin.transport.pickup_point.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->headRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('pickup-point.index')->with('success', $result['message']);
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

