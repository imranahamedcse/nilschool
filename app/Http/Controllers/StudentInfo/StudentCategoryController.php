<?php

namespace App\Http\Controllers\StudentInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\StudentInfo\StudentCategoryRepository;
use App\Http\Requests\StudentInfo\StudentCategory\StudentCategoryStoreRequest;
use App\Http\Requests\StudentInfo\StudentCategory\StudentCategoryUpdateRequest;

class StudentCategoryController extends Controller
{
    private $repo;

    function __construct(StudentCategoryRepository $repo)
    {
        $this->repo       = $repo; 
    }
    
    public function index()
    {
        $title             = ___('student_info.Categories');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'student_category_create',
            "create-route" => 'student_category.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        $data['student_categories'] = $this->repo->getPaginateAll();
        return view('backend.admin.student-info.student-category.index', compact('data'));
        
    }

    public function create()
    {
        $data['title']        = ___('student_info.Add category');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => ___('student_info.Categories'), "route" => "student_category.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.student-info.student-category.create', compact('data'));
    }

    public function store(StudentCategoryStoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('student_category.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['student_category']        = $this->repo->show($id);
        
        $data['title']       = ___('student_info.Edit category');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => ___('student_info.Categories'), "route" => "student_category.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.student-info.student-category.edit', compact('data'));
    }

    public function update(StudentCategoryUpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result){
            return redirect()->route('student_category.index')->with('success', ___('alert.updated_successfully'));
        }
        return back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
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
