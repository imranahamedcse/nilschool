<?php

namespace App\Http\Controllers\StudentInfo;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\StudentInfo\StudentCategoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StudentInfo\Category\StoreRequest;
use App\Http\Requests\StudentInfo\Category\UpdateRequest;

class StudentCategoryController extends Controller
{
    private $repo;

    function __construct(StudentCategoryInterface $repo)
    {
        $this->repo       = $repo;
    }

    public function index()
    {
        $title             = ___('common.Categories');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'student_category_create',
            "create-route" => 'student-category.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        $data['student_categories'] = $this->repo->allActive();
        return view('backend.admin.student-info.student-category.index', compact('data'));
    }

    public function create()
    {
        $data['title']        = ___('common.Add category');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => ___('common.Categories'), "route" => "student-category.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.student-info.student-category.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('student-category.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['student_category']        = $this->repo->show($id);

        $data['title']       = ___('common.Edit category');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Student Info"), "route" => ""],
            ["title" => ___('common.Categories'), "route" => "student-category.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.student-info.student-category.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result) {
            return redirect()->route('student-category.index')->with('success', ___('alert.updated_successfully'));
        }
        return back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
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
