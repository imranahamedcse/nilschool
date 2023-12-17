<?php

namespace App\Http\Controllers\OnlineExamination;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OnlineExamination\ExamTypeInterface;
use App\Http\Requests\Examination\Type\StoreRequest;
use App\Http\Requests\Examination\Type\UpdateRequest;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    private $repo;

    public function __construct(ExamTypeInterface $repo)
    {
        $this->repo       = $repo;
    }

    public function index()
    {
        $data['exam_types'] = $this->repo->all();

        $title             = ___('common.exam_type');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'exam_type_create',
            "create-route" => 'online-exam-type.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.online-examination.type.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('common.Add exam type');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Exam type"), "route" => "online-exam-type.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.admin.online-examination.type.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('online-exam-type.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('common.Edit exam type');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Exam type"), "route" => "online-exam-type.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['exam_type']        = $this->repo->show($id);
        return view('backend.admin.online-examination.type.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('online-exam-type.index')->with('success', $result['message']);
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
