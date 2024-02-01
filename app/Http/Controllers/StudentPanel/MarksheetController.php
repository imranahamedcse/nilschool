<?php

namespace App\Http\Controllers\StudentPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentInfo\SessionClassStudent;
use App\Models\StudentInfo\Student;
use App\Http\Repositories\Examination\ExamAssignRepository;
use App\Http\Repositories\Report\MarksheetRepository as ReportMarksheetRepository;
use App\Http\Repositories\StudentInfo\StudentRepository;
use App\Http\Repositories\StudentPanel\MarksheetRepository;
use App\Models\Examination\ExamType;
use PDF;

class MarksheetController extends Controller
{
    private $repo;
    private $typeRepo;
    private $reportMarksheetRepo;
    private $studentRepo;

    function __construct(
        MarksheetRepository $repo,
        ExamAssignRepository $typeRepo,
        ReportMarksheetRepository $reportMarksheetRepo,
        StudentRepository $studentRepo,
    ) {
        $this->repo = $repo;
        $this->typeRepo = $typeRepo;
        $this->reportMarksheetRepo = $reportMarksheetRepo;
        $this->studentRepo = $studentRepo;
    }

    public function index()
    {
        $data['exam_types']   = $this->typeRepo->getExamType($this->repo->index());

        $title             = ___('common.Marksheet');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['student-panel-marksheet.search', 'exam_type']
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.student.marksheet', compact('data'));
    }

    public function search(Request $request)
    {
        $data                   = $this->repo->search($request);
        $data['exam_types']     = $this->typeRepo->assignedExamType();
        $data['request']        = $request;

        $title             = ___('common.Marksheet');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['student-panel-marksheet.search', 'exam_type']
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.student.marksheet', compact('data', 'request'));
    }

    public function generatePDF($type)
    {
        $student        = Student::where('user_id', auth()->id())->first();
        $classSection   = SessionClassStudent::where('session_id', setting('session'))
            ->where('student_id', @$student->id)
            ->first();

        $request = new Request([
            'student'   => @$student->id,
            'exam_type' => $type,
            'class'     => $classSection->classes_id,
            'section'   => $classSection->section_id,
        ]);

        $data['student']      = $this->studentRepo->show(@$student->id);
        $data['resultData']   = $this->reportMarksheetRepo->search($request);

        $pdf = PDF::loadView('backend.report.marksheetPDF', compact('data'));
        return $pdf->download('marksheet' . '_' . date('d_m_Y') . '_' . @$data['student']->first_name . '_' . @$data['student']->last_name . '.pdf');
    }

    public function result(){
        $data['titles'] = [];
        $data['points'] = [];

        $types = ExamType::all();
        foreach ($types as $type) {
            $request = new Request([
                'exam_type' => $type->id,
            ]);
            $item = $this->repo->search($request);

            $data['titles'][] = $type->name;
            $data['points'][] = $item['gpa'];
        }
        $data['title'] = "Results";

        return $data;
    }
}
