<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Http\Request;
use App\Http\Interfaces\Staff\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Settings\SessionInterface;
use App\Traits\ApiReturnFormatTrait;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\SectionInterface;
use App\Http\Interfaces\Academic\SubjectInterface;
use App\Http\Repositories\Academic\ClassRoomRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\Examination\ExamRoutineRepository;
use App\Http\Repositories\Academic\TimeScheduleRepository;
use App\Http\Repositories\Academic\SubjectAssignRepository;
use App\Http\Repositories\Examination\ExamAssignRepository;
use App\Http\Requests\Academic\Routine\StoreRequest;
use App\Http\Requests\Academic\Routine\UpdateRequest;

class ExamRoutineController extends Controller
{
    use ApiReturnFormatTrait;

    private $repo;
    private $sessionRepo;
    private $classesRepo;
    private $sectionRepo;
    private $subjectRepo;
    private $staffRepo;
    private $classRoomRepo;
    private $subjectAssignRepo;
    private $timeScheduleRepo;
    private $classSetupRepo;
    private $typeRepo;

    function __construct(
        ExamRoutineRepository     $repo,
        SessionInterface          $sessionRepo,
        ClassesInterface          $classesRepo,
        SectionInterface          $sectionRepo,
        SubjectInterface          $subjectRepo,
        UserInterface             $staffRepo,
        ClassRoomRepository       $classRoomRepo,
        SubjectAssignRepository   $subjectAssignRepo,
        TimeScheduleRepository    $timeScheduleRepo,
        ClassSetupRepository      $classSetupRepo,
        ExamAssignRepository        $typeRepo,
    ) {
        $this->repo                 = $repo;
        $this->sessionRepo          = $sessionRepo;
        $this->classesRepo          = $classesRepo;
        $this->sectionRepo          = $sectionRepo;
        $this->subjectRepo          = $subjectRepo;
        $this->staffRepo            = $staffRepo;
        $this->classRoomRepo        = $classRoomRepo;
        $this->subjectAssignRepo    = $subjectAssignRepo;
        $this->timeScheduleRepo     = $timeScheduleRepo;
        $this->classSetupRepo       = $classSetupRepo;
        $this->typeRepo             = $typeRepo;
    }

    public function index()
    {
        $data['exam_routines']    = $this->repo->getPaginateAll();

        $title             = ___('academic.exam_routine');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'exam_routine_create',
            "create-route" => 'exam-routine.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Routine"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.examination.exam-routine.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('academic.Add exam routine');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Routine"), "route" => ""],
            ["title" => ___("common.Exam routine"), "route" => "exam-routine.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']            = $this->classesRepo->assignedAll();
        $data['sections']           = $this->sectionRepo->all();

        return view('backend.admin.examination.exam-routine.create', compact('data'));
    }

    public function addexamRoutine(Request $request)
    {
        $counter                 = $request->counter;


        $data['subjects']        = $this->subjectAssignRepo->getSubjects($request);

        $data['class_rooms']     = $this->classRoomRepo->all();
        $data['time_schedules']  = $this->timeScheduleRepo->allExamSchedule();
        return view('backend.admin.examination.exam-routine.add-exam-routine', compact('counter', 'data'))->render();
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('exam-routine.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']              = ___('academic.Edit exam routine');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Routine"), "route" => ""],
            ["title" => ___("common.Exam routine"), "route" => "exam-routine.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['exam_routine']      = $this->repo->show($id);

        $data['classes']            = $this->classesRepo->assignedAll();
        $data['sections']           = $this->classSetupRepo->getSections($data['exam_routine']->classes_id);

        $request = new Request([
            'class'   => $data['exam_routine']->classes_id,
            'section' => $data['exam_routine']->section_id,
        ]);
        $data['types']              = $this->typeRepo->getExamType($request); // get assigned exam type


        $data['subjects']           = $this->subjectAssignRepo->getSubjects($data['exam_routine']);

        $data['class_rooms']        = $this->classRoomRepo->all();
        $data['time_schedules']     = $this->timeScheduleRepo->allExamSchedule();

        return view('backend.admin.examination.exam-routine.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('exam-routine.index')->with('success', $result['message']);
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

    public function checkExamRoutine(Request $request)
    {

        $result = $this->repo->checkExamRoutine($request);

        return response()->json($result);
    }
}
