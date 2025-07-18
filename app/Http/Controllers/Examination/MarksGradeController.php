<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Examination\MarksGradeInterface;
use App\Http\Requests\Examination\MarksGrade\StoreRequest;
use App\Http\Requests\Examination\MarksGrade\UpdateRequest;

class MarksGradeController extends Controller
{
    private $repo;

    function __construct(MarksGradeInterface $repo)
    {
        $this->repo       = $repo;
    }

    public function index()
    {
        $data['marks_grades'] = $this->repo->all();

        $title             = ___('common.marks_grade');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'marks_grade_create',
            "create-route" => 'marks-grade.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.examination.marks-grade.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('common.Add marks rade');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Exam group"), "route" => "marks-grade.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.examination.marks-grade.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('marks-grade.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit marks grade');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Exam group"), "route" => "marks-grade.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['marks_grade']        = $this->repo->show($id);
        return view('backend.admin.examination.marks-grade.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('marks-grade.index')->with('success', $result['message']);
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
