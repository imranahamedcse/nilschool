<?php

namespace App\Http\Controllers\OnlineExamination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Interfaces\OnlineExamination\QuestionBankInterface;
use App\Http\Requests\OnlineExamination\QuestionBank\StoreRequest;
use App\Http\Requests\OnlineExamination\QuestionBank\UpdateRequest;
use App\Http\Interfaces\OnlineExamination\QuestionGroupInterface;

class QuestionBankController extends Controller
{
    private $repo;
    private $groupRepo;

    function __construct(
        QuestionBankInterface $repo,
        QuestionGroupInterface $groupRepo,
    )
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->groupRepo  = $groupRepo;
        $this->repo       = $repo;
    }

    public function index()
    {
        $data['question_bank'] = $this->repo->all();

        $title         = ___('index.question_bank');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'question_bank_create',
            "create-route" => 'question-bank.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Online Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.online-examination.question-bank.index', compact('data'));
    }


    public function search(Request $request)
    {
        $title         = ___('index.question_bank');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'question_bank_create',
            "create-route" => 'question-bank.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Online Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['request']        = $request;
        $data['question_bank']  = $this->repo->search($request);
        return view('backend.admin.online-examination.question-bank.index', compact('data'));
    }

    public function create()
    {
        $data['title']          = ___('index.Add question bank');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Online Examination"), "route" => ""],
            ["title" => ___("common.Question group"), "route" => "question-bank.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.online-examination.question-bank.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect()->route('question-bank.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']         = ___('index.Edit question bank');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Online Examination"), "route" => ""],
            ["title" => ___("common.Question group"), "route" => "question-bank.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['question_bank'] = $this->repo->show($id);
        $data['question_group']= $this->groupRepo->show($data['question_bank']->question_group_id);
        return view('backend.admin.online-examination.question-bank.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if($result['status']){
            return redirect()->route('question-bank.index')->with('success', $result['message']);
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

    public function getQuestionGroup(Request $request)
    {
        $result = $this->repo->getQuestionGroup($request);
        return response()->json($result);
    }
}
