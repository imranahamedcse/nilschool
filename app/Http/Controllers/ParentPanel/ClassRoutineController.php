<?php

namespace App\Http\Controllers\ParentPanel;

use App\Http\Controllers\Controller;
use App\Models\StudentInfo\SessionClassStudent;
use App\Models\StudentInfo\Student;
use App\Http\Repositories\ParentPanel\ClassRoutineRepository;
use App\Http\Repositories\Report\ClassRoutineRepository as ReportClassRoutineRepository;
use Illuminate\Http\Request;
use PDF;

class ClassRoutineController extends Controller
{
    private $reportClassRoutineRepo;
    private $repo;

    function __construct(ReportClassRoutineRepository $reportClassRoutineRepo, ClassRoutineRepository $repo)
    {
        $this->reportClassRoutineRepo = $reportClassRoutineRepo;
        $this->repo               = $repo;
    }

    public function index()
    {
        $data = $this->repo->index();

        $title             = ___('common.Class routine');
        $data['headers']   = [
            "title"        => $title,
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.parent.class-routine', compact('data'));
    }

    public function generatePDF($student)
    {
        $student        = Student::where('id', $student)->first();
        $classSection   = SessionClassStudent::where('session_id', setting('session'))
                        ->where('student_id', @$student->id)
                        ->first();

        $request = new Request([
            'class'        => $classSection->classes_id,
            'section'      => $classSection->section_id
        ]);

        $data['result']       = $this->reportClassRoutineRepo->search($request);
        $data['time']         = $this->reportClassRoutineRepo->time($request);

        $pdf = PDF::loadView('backend.report.class-routinePDF', compact('data'));
        return $pdf->download('class_routine'.'_'.date('d_m_Y').'.pdf');
    }
}
