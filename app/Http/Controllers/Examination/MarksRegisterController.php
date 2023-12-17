<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Academic\SectionInterface;
use App\Http\Interfaces\Academic\SubjectInterface;
use App\Http\Interfaces\Examination\ExamAssignInterface;
use App\Http\Interfaces\Examination\MarksRegisterInterface;
use App\Http\Interfaces\StudentInfo\StudentInterface;
use App\Http\Requests\Examination\MarksRegister\StoreRequest;
use App\Http\Requests\Examination\MarksRegister\UpdateRequest;

class MarksRegisterController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;
    private $sectionRepo;
    private $subjectRepo;
    private $examAssignRepo;
    private $studentRepo;

    function __construct(
        MarksRegisterInterface $repo,
        ClassSetupInterface $classSetupRepo,
        ClassesInterface $classRepo,
        SectionInterface $sectionRepo,
        SubjectInterface $subjectRepo,
        ExamAssignInterface $examAssignRepo,
        StudentInterface $studentRepo,
    ) {
        $this->repo               = $repo;
        $this->classRepo          = $classRepo;
        $this->classSetupRepo     = $classSetupRepo;
        $this->sectionRepo        = $sectionRepo;
        $this->subjectRepo        = $subjectRepo;
        $this->examAssignRepo     = $examAssignRepo;
        $this->studentRepo        = $studentRepo;
    }

    public function index()
    {
        $data['classes']            = $this->classRepo->assignedAll();
        $data['marks_registers']    = $this->repo->all();
        $data['sections'] = [];
        $data['exam_types'] = [];

        $title             = ___('common.Marks register');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['marks-register.search', 'class', 'section', 'exam_type', 'subject'],
            "create-permission"   => 'marks_register_create',
            "create-route" => 'marks-register.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.examination.marks-register.index', compact('data'));
    }

    public function search(Request $request)
    {
        $title             = ___('common.Marks register');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['marks-register.search', 'class', 'section', 'exam_type', 'subject'],
            "create-permission"   => 'marks_register_create',
            "create-route" => 'marks-register.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['marks_registers']    = $this->repo->searchMarkRegister($request);
        $data['sections'] = [];
        return view('backend.admin.examination.marks-register.index', compact('data'));
    }


    public function show(Request $request)
    {
        $data['marks_register']        = $this->repo->show($request->id);


        $request = new Request([
            'class'     => $data['marks_register']->classes_id,
            'section'   => $data['marks_register']->section_id,
            'exam_type' => $data['marks_register']->exam_type_id,
            'subject'   => $data['marks_register']->subject_id
        ]);

        $data['examAssign']            = $this->examAssignRepo->getExamAssign($request);
        $data['students']              = $this->studentRepo->getStudents($request);


        return view('backend.admin.examination.marks-register.view', compact('data'));
    }

    public function create()
    {
        $data['title']                  = ___('common.marks_register');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Marks register"), "route" => "marks-register.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']                = $this->classSetupRepo->allActive();
        $data['exam_types']             = $this->examAssignRepo->assignedExamType();
        return view('backend.admin.examination.marks-register.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('marks-register.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['classes']               = $this->classSetupRepo->allActive();
        $data['sections']              = $this->sectionRepo->allActive();

        $data['subjects']              = $this->subjectRepo->allActive();
        $data['marks_register']        = $this->repo->show($id);

        $data['title']                 = ___('common.marks_register');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Examination"), "route" => ""],
            ["title" => ___("common.Marks register"), "route" => "marks-register.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $request = new Request([
            'class'     => $data['marks_register']->classes_id,
            'section'   => $data['marks_register']->section_id,
        ]);
        $data['exam_types']            = $this->examAssignRepo->getExamType($request); // get assigned exam type

        $request = new Request([
            'class'     => $data['marks_register']->classes_id,
            'section'   => $data['marks_register']->section_id,
            'exam_type' => $data['marks_register']->exam_type_id,
            'subject'   => $data['marks_register']->subject_id
        ]);

        $data['examAssign']            = $this->examAssignRepo->getExamAssign($request);
        $data['students']              = $this->studentRepo->getStudents($request);
        return view('backend.admin.examination.marks-register.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('marks-register.index')->with('success', $result['message']);
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
