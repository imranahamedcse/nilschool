<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Http\Request;
use App\Models\Academic\Section;
use App\Models\Academic\Subject;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Examination\ExamAssignInterface;
use App\Http\Interfaces\Examination\ExamTypeInterface;
use App\Models\Examination\ExamType;
use App\Models\Academic\SubjectAssign;
use App\Models\Academic\SubjectAssignChildren;
use App\Http\Requests\Examination\Assign\StoreRequest;
use App\Http\Requests\Examination\Assign\UpdateRequest;

class ExamAssignController extends Controller
{
    private $repo;
    private $classRepo;
    private $examTypeRepo;
    private $classSetupRepo;

    function __construct(
        ExamAssignInterface $repo,
        ClassesInterface    $classRepo,
        ExamTypeInterface   $examTypeRepo,
        ClassSetupInterface $classSetupRepo,
    ) {
        $this->repo               = $repo;
        $this->classRepo          = $classRepo;
        $this->examTypeRepo       = $examTypeRepo;
        $this->classSetupRepo     = $classSetupRepo;
    }

    public function index()
    {
        $data['classes']      = $this->classRepo->assignedAll();

        $data['sections'] = [];
        $data['exam_assigns'] = $this->repo->all();
        $data['exam_types'] = [];

        $title             = ___('common.exam_assign');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['exam-assign.search', 'class', 'section', 'exam_type', 'subject'],
            "create-permission" => 'exam_assign_create',
            "create-route" => 'exam-assign.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.admin.examination.exam-assign.index', compact('data'));
    }

    public function search(Request $request)
    {
        $title             = ___('common.exam_assign');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['exam-assign.search', 'class', 'section', 'exam_type', 'subject'],
            "create-permission" => 'exam_assign_create',
            "create-route" => 'exam-assign.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['exam_assigns'] = $this->repo->searchExamAssign($request);
        $data['subjectArr']   = Subject::pluck('name', 'id')->toArray();
        $data['sectionArr']   = Section::pluck('name', 'id')->toArray();
        $data['examArr']      = ExamType::pluck('name', 'id')->toArray();
        $data['classes']      = $this->classRepo->assignedAll();

        $data['sections'] = [];

        return view('backend.admin.examination.exam-assign.index', compact('data'));
    }

    public function create()
    {
        $data['title']                  = ___('common.Add exam assign');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Exam group"), "route" => "exam-assign.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']                = $this->classSetupRepo->allActive();
        $data['exam_types']             = $this->examTypeRepo->allActive();
        return view('backend.admin.examination.exam-assign.create', compact('data'));
    }

    public function marksDistribution(Request $request)
    {
        return view('backend.admin.examination.exam-assign.marks_distribute', compact('request'))->render();
    }

    public function subjectMarksDistribution(Request $request)
    {
        $subjectArr   = Subject::pluck('name', 'id')->toArray();
        return view('backend.admin.examination.exam-assign.subject_marks_distribute', compact('subjectArr', 'request'))->render();
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('exam-assign.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $result = $this->repo->show($id);
        if (!$result)
            return redirect()->route('exam-assign.index')->with('danger', 'You cannot edit this! because, already marks registred.');

        $data['title']              = ___('common.Edit exam assign');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Exam group"), "route" => "exam-assign.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['exam_assign']        = $result;
        $data['classes']            = $this->classRepo->allActive();
        $data['sections']           = $this->classSetupRepo->getSections($data['exam_assign']->classes_id);


        $result                   = SubjectAssign::active()->where('session_id', setting('session'))->where('classes_id', $data['exam_assign']->classes_id)->where('section_id', $data['exam_assign']->section_id)->first();
        $data['subjects']         = SubjectAssignChildren::with('subject')->where('subject_assign_id', @$result->id)->select('subject_id')->get();

        $data['exam_types']         = $this->examTypeRepo->allActive();

        return view('backend.admin.examination.exam-assign.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('exam-assign.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function checkMarkRegister($id)
    {
        $result = $this->repo->checkMarkRegister($id);
        return response()->json($result, 200);
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

    public function getSections(Request $request)
    {
        $data = $this->classSetupRepo->getSections($request->id);

        return response()->json($data);
    }

    public function getSubjects(Request $request)
    {
        $result = $this->repo->getSubjects($request);
        return response()->json($result, 200);
    }

    public function getExamType(Request $request)
    {
        $result = $this->repo->getExamType($request);
        return response()->json($result, 200);
    }

    public function checkSubmit(Request $request)
    {
        $result = $this->repo->checkSubmit($request);
        return response()->json($result, 200);
    }
}
