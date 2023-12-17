<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transport\Route\StoreRequest;
use App\Http\Requests\Transport\Route\UpdateRequest;
use App\Http\Interfaces\Transport\RouteInterface;
use Illuminate\Support\Facades\Schema;

class RouteController extends Controller
{
    private $repo;

    function __construct(RouteInterface $repo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->repo       = $repo; 
    }

    public function index()
    {
        $data['route'] = $this->repo->getAll();

        $title             = ___('common.Route');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'route_create',
            "create-route" => 'route.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.transport.route.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Route'), "route" => "route.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.transport.route.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('route.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Transport"), "route" => ""],
            ["title" => ___('common.Route'), "route" => "route.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        
        $data['route']        = $this->repo->show($id);
        return view('backend.admin.transport.route.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('route.index')->with('success', $result['message']);
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

