<?php

namespace App\Http\Controllers\StudentPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Examination\ExamAssign;
use App\Models\StudentInfo\SessionClassStudent;
use App\Models\StudentInfo\Student;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\Examination\ExamAssignRepository;
use App\Http\Repositories\Report\ExamRoutineRepository as ReportExamRoutineRepository;
use App\Http\Repositories\StudentPanel\ExamRoutineRepository;
use PDF;

class ExamRoutineController extends Controller
{
    private $reportExamRoutineRepo;
    private $repo;
    private $typeRepo;

    function __construct(ReportExamRoutineRepository  $reportExamRoutineRepo, ExamRoutineRepository $repo, ExamAssignRepository $typeRepo,) 
    { 
        $this->reportExamRoutineRepo    = $reportExamRoutineRepo; 
        $this->repo         = $repo; 
        $this->typeRepo     = $typeRepo;
    }

    public function index()
    {
        $data['exam_types']   = $this->typeRepo->getExamType($this->repo->index());
        return view('student-panel.exam-routine', compact('data'));
    }

    public function search(Request $request)
    {
        $data = $this->repo->search($request);
        $data['exam_types']   = $this->typeRepo->getExamType($this->repo->index());
        return view('student-panel.exam-routine', compact('data','request'));
    }

    public function generatePDF($type)
    {
        $student        = Student::where('user_id', Auth::user()->id)->first();
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
