<?php

namespace App\Http\Controllers\ParentPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentInfo\SessionClassStudent;
use App\Models\StudentInfo\Student;
use App\Http\Repositories\StudentInfo\StudentRepository;
use App\Http\Repositories\Examination\ExamAssignRepository;
use App\Http\Repositories\ParentPanel\ExamRoutineRepository;
use App\Http\Repositories\Report\ExamRoutineRepository as ReportExamRoutineRepository;
use Illuminate\Support\Facades\Session;
use PDF;

class ExamRoutineController extends Controller
{
    private $reportExamRoutineRepo;
    private $repo;
    private $typeRepo;

    function __construct( ReportExamRoutineRepository $reportExamRoutineRepo, ExamRoutineRepository $repo, ExamAssignRepository $typeRepo)
    {
        $this->reportExamRoutineRepo = $reportExamRoutineRepo;
        $this->repo = $repo;
        $this->typeRepo = $typeRepo;
    }

    public function getExamTypes()
    {
        return $this->typeRepo->getExamType($this->repo->studentInfo(Session::get('student_id'))); // student id
    }


    public function index()
    {
        $data = $this->repo->index();
        $data['exam_types'] = $this->getExamTypes();

        $title             = ___('common.Exam routine');
        $data['headers']   = [
            "title"        => $title,
            "filter"       => ['parent-panel-exam-routine.search', 'exam_type'],
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.parent.exam-routine', compact('data'));
    }

    public function search(Request $request)
    {
        $data = $this->repo->search($request);
        $data['request'] = $request;
        $data['exam_types'] = $this->getExamTypes();

        $title             = ___('common.Exam routine');
        $data['headers']   = [
            "title"        => $title,
            "filter"       => ['parent-panel-exam-routine.search', 'exam_type'],
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.parent.exam-routine', compact('data','request'));
    }

    public function generatePDF($student, $type)
    {
        $student        = Student::where('id', $student)->first();
        $classSection   = SessionClassStudent::where('session_id', setting('session'))
                        ->where('student_id', @$student->id)
                        ->first();

        $request = new Request([
            'class'        => $classSection->classes_id,
            'section'      => $classSection->section_id,
            'type'         => $type,
        ]);

        $data['result']       = $this->reportExamRoutineRepo->search($request);
        $data['time']         = $this->reportExamRoutineRepo->time($request);

        $pdf = PDF::loadView('backend.report.exam-routinePDF', compact('data'));
        return $pdf->download('exam_routine'.'_'.date('d_m_Y').'.pdf');
    }
}
