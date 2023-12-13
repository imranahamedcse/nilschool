<?php

namespace App\Http\Controllers\StudentInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\StudentInfo\ParentGuardianRepository;
use App\Http\Requests\StudentInfo\ParentGuardian\StoreRequest;
use App\Http\Requests\StudentInfo\ParentGuardian\UpdateRequest;

class ParentGuardianController extends Controller
{
    private $repo;

    function __construct(ParentGuardianRepository $repo)
    {
        $this->repo       = $repo;
    }

    public function index()
    {
        $title             = ___('student_info.parent_list');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'parent_create',
            "create-route" => 'parent.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];

        $data['parents'] = $this->repo->getPaginateAll();
        return view('backend.admin.student-info.parent.index', compact('data'));
    }

    public function search(Request $request)
    {
        $title             = ___('student_info.parent_list');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'parent_create',
            "create-route" => 'parent.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];

        $data['request'] = $request;
        $data['parents'] = $this->repo->searchParent($request);
        return view('backend.admin.student-info.parent.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('student_info.parent_create');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.student-info.parent.create', compact('data'));
    }

    public function getParent(Request $request)
    {
        $result = $this->repo->getParent($request);
        return response()->json($result);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('parent.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['parent']      = $this->repo->show($id);
        $data['title']       = ___('student_info.parent_edit');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.student-info.parent.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result){
            return redirect()->route('parent.index')->with('success', $result['message']);
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
