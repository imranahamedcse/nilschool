<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Academic\ClassSetup\StoreRequest;
use App\Http\Requests\Academic\ClassSetup\UpdateRequest;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Academic\SectionInterface;

class ClassSetupController extends Controller
{
    private $repo, $classes, $section;

    function __construct(
        ClassSetupInterface $repo,
        ClassesInterface $classes,
        SectionInterface $section
    ) {
        $this->repo          = $repo;
        $this->classes       = $classes;
        $this->section       = $section;
    }

    public function getSections(Request $request)
    {
        $data = $this->repo->getSections($request->id);
        return response()->json($data);
    }

    public function index()
    {
        $data['class_setups']       = $this->repo->all();

        $title             = ___('academic.class_setup');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'class_setup_create',
            "create-route" => 'class-setup.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];


        return view('backend.admin.academic.class_setup.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('academic.Add class setup');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Class setup"), "route" => "class-setup.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']            = $this->classes->allActive();
        $data['section']            = $this->section->allActive();
        return view('backend.admin.academic.class_setup.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('class-setup.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']              = ___('academic.Edit class setup');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Class setup"), "route" => "class-setup.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['class_setup']        = $this->repo->show($id);
        $data['classes']            = $this->classes->allActive();
        $data['section']            = $this->section->allActive();

        $data['class_setup_sections']  = $data['class_setup']->classSetupChildrenAll->pluck('section_id')->toArray();

        return view('backend.admin.academic.class_setup.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('class-setup.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {

        $result = $this->repo->destroy($id);
        if ($result['status']) :
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else :
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;
    }
}
