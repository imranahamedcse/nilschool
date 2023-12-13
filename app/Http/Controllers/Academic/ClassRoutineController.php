<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Http\Interfaces\Staff\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Settings\SessionInterface;
use App\Traits\ApiReturnFormatTrait;
use App\Http\Interfaces\Academic\ShiftInterface;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\SectionInterface;
use App\Http\Interfaces\Academic\SubjectInterface;
use App\Http\Repositories\Academic\ClassRoomRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\Academic\ClassRoutineRepository;
use App\Http\Repositories\Academic\TimeScheduleRepository;
use App\Http\Repositories\Academic\SubjectAssignRepository;
use App\Http\Requests\Academic\Routine\StoreRequest;
use App\Http\Requests\Academic\Routine\UpdateRequest;

class ClassRoutineController extends Controller
{
    use ApiReturnFormatTrait;

    private $repo;
    private $sessionRepo;
    private $classesRepo;
    private $sectionRepo;
    private $shiftRepo;
    private $subjectRepo;
    private $staffRepo;
    private $classRoomRepo;
    private $subjectAssignRepo;
    private $timeScheduleRepo;
    private $classSetupRepo;

    function __construct(
        ClassRoutineRepository    $repo,
        SessionInterface          $sessionRepo,
        ClassesInterface          $classesRepo,
        SectionInterface          $sectionRepo,
        ShiftInterface            $shiftRepo,
        SubjectInterface          $subjectRepo,
        UserInterface             $staffRepo,
        ClassRoomRepository       $classRoomRepo,
        SubjectAssignRepository   $subjectAssignRepo,
        TimeScheduleRepository    $timeScheduleRepo,
        ClassSetupRepository      $classSetupRepo,
    ) {
        $this->repo                 = $repo;
        $this->sessionRepo          = $sessionRepo;
        $this->classesRepo          = $classesRepo;
        $this->sectionRepo          = $sectionRepo;
        $this->shiftRepo            = $shiftRepo;
        $this->subjectRepo          = $subjectRepo;
        $this->staffRepo            = $staffRepo;
        $this->classRoomRepo        = $classRoomRepo;
        $this->subjectAssignRepo    = $subjectAssignRepo;
        $this->timeScheduleRepo     = $timeScheduleRepo;
        $this->classSetupRepo       = $classSetupRepo;
    }

    public function index()
    {
        $data['class_routines']    = $this->repo->getPaginateAll();

        $title             = ___('academic.class_routine');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'class_routine_create',
            "create-route" => 'class-routine.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Routine"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.academic.class-routine.index', compact('data'));
    }

    public function create()
    {
        $data['title']              = ___('academic.Add class routine');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Routine"), "route" => ""],
            ["title" => ___("common.Class routine"), "route" => "class-routine.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['classes']            = $this->classesRepo->assignedAll();
        $data['sections']           = $this->sectionRepo->all();
        $data['shifts']             = $this->shiftRepo->all();
        // $data['subjects']           = $this->subjectRepo->all();
        return view('backend.admin.academic.class-routine.create', compact('data'));
    }

    public function addClassRoutine(Request $request)
    {
        $counter                 = $request->counter;


        $data['subjects']        = $this->subjectAssignRepo->getSubjects($request);
        // $data['subjects']        = $this->subjectRepo->all();
        // $data['teachers']        = $this->staffRepo->all();
        $data['class_rooms']     = $this->classRoomRepo->all();
        $data['time_schedules']  = $this->timeScheduleRepo->allClassSchedule();
        return view('backend.admin.academic.class-routine.add-class-routine', compact('counter', 'data'))->render();
    }

    public function store(StoreRequest $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect()->route('class-routine.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']              = ___('academic.Edit class routine');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Routine"), "route" => ""],
            ["title" => ___("common.Class routine"), "route" => "class-routine.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['class_routine']      = $this->repo->show($id);

        $data['classes']            = $this->classesRepo->assignedAll();
        $data['sections']           = $this->classSetupRepo->getSections($data['class_routine']->classes_id);


        $data['shifts']             = $this->shiftRepo->all();
        $data['subjects']           = $this->subjectAssignRepo->getSubjects($data['class_routine']);

        $data['class_rooms']        = $this->classRoomRepo->all();
        $data['time_schedules']     = $this->timeScheduleRepo->allClassSchedule();

        return view('backend.admin.academic.class-routine.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->repo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('class-routine.index')->with('success', $result['message']);
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

    public function checkClassRoutine(Request $request)
    {

        $result = $this->repo->checkClassRoutine($request);

        return response()->json($result);
    }
}
