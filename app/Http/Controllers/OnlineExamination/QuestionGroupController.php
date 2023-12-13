<?php

namespace App\Http\Controllers\OnlineExamination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Interfaces\OnlineExamination\QuestionGroupInterface;
use App\Http\Requests\OnlineExamination\QuestionGroup\StoreRequest;
use App\Http\Requests\OnlineExamination\QuestionGroup\UpdateRequest;

class QuestionGroupController extends Controller
{
    private $repo;

    function __construct(
        QuestionGroupInterface       $repo,
    )
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->repo           = $repo; 
    }

    public function index()
    {
        $data['question_group'] = $this->repo->getAll();

        $title             = ___('online-examination.Question group');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'question_group_create',
            "create-route" => 'question-group.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Online Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.online-examination.question-group.index', compact('data'));
    }

    public function search(Request $request)
    {
        $title             = ___('online-examination.Question group');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'question_group_create',
            "create-route" => 'question-group.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Online Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        
        $data['request']        = $request;
        $data['question_group'] = $this->repo->search($request);
        return view('backend.admin.online-examination.question-group.index', compact('data'));
    }

    public function create()
    {
        $data['title'] = ___('online-examination.Add question group');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Online Examination"), "route" => ""],
            ["title" => ___("common.Question group"), "route" => "question-group.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.online-examination.question-group.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('question-group.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']        = ___('online-examination.Edit question group');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Online Examination"), "route" => ""],
            ["title" => ___("common.Question group"), "route" => "question-group.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['question_group']        = $this->repo->show($id);
        return view('backend.admin.online-examination.question-group.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('question-group.index')->with('success', $result['message']);
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
