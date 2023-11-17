<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Academic\Classes\ClassesStoreRequest;
use App\Http\Requests\Academic\Classes\ClassesUpdateRequest;
use App\Interfaces\Academic\ClassesInterface;
use Illuminate\Support\Facades\Schema;

class ClassesController extends Controller
{
    private $classes;

    function __construct(ClassesInterface $classes)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->classes       = $classes; 
    }

    public function index()
    {
        $data['class'] = $this->classes->getAll();
        $data['title'] = ___('academic.class');
        return view('backend.academic.class.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('academic.create_class');
        return view('backend.academic.class.create', compact('data'));
    }

    public function store(ClassesStoreRequest $request)
    {
        $result = $this->classes->store($request);
        if($result['status']){
            return redirect()->route('classes.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['class']       = $this->classes->show($id);
        $data['title']       = ___('academic.edit_class');
        return view('backend.academic.class.edit', compact('data'));
    }

    public function update(ClassesUpdateRequest $request, $id)
    {
        $result = $this->classes->update($request, $id);
        if($result['status']){
            return redirect()->route('classes.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->classes->destroy($id);
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
