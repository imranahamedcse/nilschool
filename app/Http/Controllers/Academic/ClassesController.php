<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Requests\Academic\Classes\StoreRequest;
use App\Http\Requests\Academic\Classes\UpdateRequest;
use Illuminate\Support\Facades\Schema;

class ClassesController extends Controller
{
    private $classes;

    function __construct(ClassesInterface $classes)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->classes       = $classes;
    }

    public function index()
    {
        $data['class']     = $this->classes->all();
        $title             = ___('common.class');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'classes_create',
            "create-route" => 'classes.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.academic.class.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('common.create_class');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Class"), "route" => "classes.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.academic.class.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->classes->store($request);
        if ($result['status']) {
            return redirect()->route('classes.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['class']       = $this->classes->show($id);
        $data['title']       = ___('common.edit_class');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Class"), "route" => "classes.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.academic.class.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->classes->update($request, $id);
        if ($result['status']) {
            return redirect()->route('classes.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->classes->destroy($id);
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
