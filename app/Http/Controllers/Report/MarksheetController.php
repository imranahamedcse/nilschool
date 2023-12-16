<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Examination\ExamTypeInterface;
use App\Http\Interfaces\Report\MarksheetInterface;
use App\Http\Interfaces\StudentInfo\StudentInterface;
use App\Http\Requests\Report\Marksheet\SearchRequest;
use PDF;

class MarksheetController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;
    private $studentRepo;
    private $examTypeRepo;

    function __construct(
        MarksheetInterface    $repo,
        ClassesInterface      $classRepo,
        ClassSetupInterface   $classSetupRepo,
        StudentInterface      $studentRepo,
        ExamTypeInterface     $examTypeRepo,
    )
    {
        $this->repo               = $repo;
        $this->classRepo          = $classRepo;
        $this->classSetupRepo     = $classSetupRepo;
        $this->studentRepo        = $studentRepo;
        $this->examTypeRepo       = $examTypeRepo;
    }

    public function index()
    {
        $title             = ___('student_info.Marksheet');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['marksheet.search', 'class', 'section', 'exam_type', 'student'],
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
        $data['exam_types']         = [];

        return view('backend.admin.report.marksheet', compact('data'));
    }

    public function getStudents(Request $request){
        return $this->studentRepo->getStudents($request);
    }

    public function search(SearchRequest $request)
    {
        $title             = ___('student_info.Marksheet');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['marksheet.search', 'class', 'section', 'exam_type', 'student'],
            "create-permission"   => '',
            "create-route" => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Report"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        $data['student']      = $this->studentRepo->show($request->student);
        $data['resultData']   = $this->repo->search($request);
        $data['request']      = $request;
        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = $this->classSetupRepo->getSections($request->class);
        $data['students']     = $this->studentRepo->getStudents($request);
        $data['exam_types']   = $this->examTypeRepo->all();

        return view('backend.admin.report.marksheet', compact('data'));
    }

    public function generatePDF($id, $type, $class, $section)
    {
        $request = new Request([
            'student'   => $id,
            'exam_type' => $type,
            'class'     => $class,
            'section'   => $section,
        ]);

        $data['student']      = $this->studentRepo->show($request->student);
        $data['resultData']   = $this->repo->search($request);

        $pdf = PDF::loadView('backend.admin.report.marksheetPDF', compact('data'));
        return $pdf->download('marksheet'.'_'.date('d_m_Y').'_'.@$data['student']->first_name .'_'. @$data['student']->last_name .'.pdf');
    }
}
