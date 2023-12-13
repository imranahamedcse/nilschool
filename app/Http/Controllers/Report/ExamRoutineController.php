<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\Report\ExamRoutineRepository;
use App\Http\Repositories\Examination\ExamAssignRepository;
use App\Http\Requests\Report\ExamRoutine\SearchRequest;
use App\Http\Repositories\Academic\TimeScheduleRepository;
use App\Http\Repositories\Examination\ExamTypeRepository;
use PDF;

class ExamRoutineController extends Controller
{
    private $repo;
    private $examAssignRepo;
    private $classRepo;
    private $classSetupRepo;
    private $timeScheduleRepo;
    private $typeRepo;

    function __construct(
        ExamRoutineRepository  $repo,
        ExamAssignRepository   $examAssignRepo,
        ClassesRepository      $classRepo,
        ClassSetupRepository   $classSetupRepo,
        TimeScheduleRepository $timeScheduleRepo,
        ExamTypeRepository     $typeRepo,
    )
    {
        $this->repo               = $repo;
        $this->examAssignRepo     = $examAssignRepo;
        $this->classRepo          = $classRepo;
        $this->classSetupRepo     = $classSetupRepo;
        $this->timeScheduleRepo   = $timeScheduleRepo;
        $this->typeRepo           = $typeRepo;
    }

    public function index()
    {
        $title             = ___('student_info.Exam routine');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['report-exam-routine.search', 'class', 'section', 'exam_type'],
            "create-permission"   => '',
            "create-route" => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Report"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];
        $data['exam_types']         = [];

        return view('backend.admin.report.exam-routine', compact('data'));
    }

    public function search(SearchRequest $request)
    {
        $title             = ___('student_info.Exam routine');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['report-exam-routine.search', 'class', 'section', 'exam_type'],
            "create-permission"   => '',
            "create-route" => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Report"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['result']       = $this->repo->search($request);
        $data['time']         = $this->repo->time($request);
        $data['request']      = $request;
        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = $this->classSetupRepo->getSections($request->class);
        $data['exam_types']   = $this->typeRepo->all();

        return view('backend.admin.report.exam-routine', compact('data'));
    }

    public function generatePDF($class, $section, $type)
    {
        $request = new Request([
            'class'        => $class,
            'section'      => $section,
            'type'         => $type,
        ]);

        $data['result']       = $this->repo->search($request);
        $data['time']         = $this->repo->time($request);

        $pdf = PDF::loadView('backend.admin.report.exam-routinePDF', compact('data'));
        return $pdf->download('exam_routine'.'_'.date('d_m_Y').'.pdf');
    }
}
