<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResource\Department\StoreRequest;
use App\Http\Requests\HumanResource\Department\UpdateRequest;
use App\Http\Interfaces\HumanResource\DepartmentInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private $repo;

    function __construct(DepartmentInterface $repo)
    {
        $this->repo       = $repo;
    }

    public function index()
    {
        $data['departments'] = $this->repo->all();

        $title             = ___('common.department');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'department_create',
            "create-route" => 'department.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.human_resource.department.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('common.department');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => ___("common.Department"), "route" => "department.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.human_resource.department.create', compact('data'));

    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('department.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.department');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Staff Manage"), "route" => ""],
            ["title" => ___("common.Department"), "route" => "department.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['department']        = $this->repo->show($id);
        return view('backend.admin.human_resource.department.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result){
            return redirect()->route('department.index')->with('success', $result['message']);
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
