<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Examination\ExamAssignInterface;
use App\Http\Interfaces\Report\ProgressCardInterface;
use App\Http\Interfaces\StudentInfo\StudentInterface;
use App\Http\Requests\Report\ProgressCard\SearchRequest;
use PDF;

class ProgressCardController extends Controller
{
    private $repo;
    private $examAssignRepo;
    private $classRepo;
    private $classSetupRepo;
    private $studentRepo;

    function __construct(
        ProgressCardInterface $repo,
        ExamAssignInterface   $examAssignRepo,
        ClassesInterface      $classRepo,
        ClassSetupInterface   $classSetupRepo,
        StudentInterface      $studentRepo,
    )
    {
        $this->repo               = $repo;
        $this->examAssignRepo     = $examAssignRepo;
        $this->classRepo          = $classRepo;
        $this->classSetupRepo     = $classSetupRepo;
        $this->studentRepo        = $studentRepo;
    }

    public function index()
    {
        $title             = ___('common.Progress Card');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['report-progress-card.search', 'class', 'section', 'student'],
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
        $data['students']           = [];
        return view('backend.admin.report.progress-card', compact('data'));
    }

    public function getStudents(Request $request){
        return $this->studentRepo->getStudents($request);
    }

    public function search(SearchRequest $request)
    {
        $data                 = $this->repo->search($request);

        $title             = ___('common.Progress Card');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['report-progress-card.search', 'class', 'section', 'student'],
            "create-permission"   => '',
            "create-route" => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Report"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['student']      = $this->studentRepo->show($request->student);
        $data['exam_types']   = $this->examAssignRepo->assignedExamType();
        $data['request']      = $request;
        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = $this->classSetupRepo->getSections($request->class);
        $data['students']     = $this->studentRepo->getStudents($request);

        return view('backend.admin.report.progress-card', compact('data'));
    }

    public function generatePDF($class, $section, $student)
    {
        $request = new Request([
            'class'     => $class,
            'section'   => $section,
            'student'   => $student,
        ]);

        $data                 = $this->repo->search($request);
        $data['student']      = $this->studentRepo->show($request->student);

        $pdf = PDF::loadView('backend.admin.report.progress-cardPDF', compact('data'));
        return $pdf->download('progress_card'.'_'.date('d_m_Y').'_'.@$data['student']->first_name .'_'. @$data['student']->last_name .'.pdf');
    }
}
