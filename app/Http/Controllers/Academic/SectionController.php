<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Academic\Section\StoreRequest;
use App\Http\Requests\Academic\Section\UpdateRequest;
use App\Http\Interfaces\Academic\SectionInterface;
use Illuminate\Support\Facades\Schema;

class SectionController extends Controller
{
    private $section;

    function __construct(SectionInterface $section)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->section       = $section;
    }

    public function index()
    {
        $data['section'] = $this->section->all();
        $title = ___('common.section');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'section_create',
            "create-route" => 'section.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.academic.section.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.Add section');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Section"), "route" => "section.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.academic.section.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->section->store($request);
        if ($result['status']) {
            return redirect()->route('section.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['section']  = $this->section->show($id);
        $data['title']    = ___('common.Edit section');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Section"), "route" => "section.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.academic.section.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->section->update($request, $id);
        if ($result['status']) {
            return redirect()->route('section.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->section->destroy($id);
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
