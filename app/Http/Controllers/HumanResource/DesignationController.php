<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResource\Designation\StoreRequest;
use App\Http\Requests\HumanResource\Designation\UpdateRequest;
use App\Http\Interfaces\HumanResource\DesignationInterface;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    private $repo;

    function __construct(DesignationInterface $repo)
    {
        $this->repo       = $repo;
    }

    public function index()
    {
        $data['designations'] = $this->repo->all();

        $title             = ___('common.designation');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'designation_create',
            "create-route" => 'designation.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.human_resource.designation.index', compact('data'));

    }

    public function create()
    {
        $data['title']              = ___('common.designation');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => ___("common.Designation"), "route" => "designation.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.human_resource.designation.create', compact('data'));

    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('designation.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.designation');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => ___("common.Designation"), "route" => "designation.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['designation']        = $this->repo->show($id);
        return view('backend.admin.human_resource.designation.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result){
            return redirect()->route('designation.index')->with('success', $result['message']);
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
