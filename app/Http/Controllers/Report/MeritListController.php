<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Requests\Report\MeritListRequest;
use App\Http\Interfaces\Academic\ShiftInterface;
use App\Http\Interfaces\Examination\ExamTypeInterface;
use App\Http\Interfaces\Report\MeritListInterface;
use App\Http\Interfaces\StudentInfo\StudentInterface;
use PDF;

class MeritListController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;
    private $studentRepo;
    private $examTypeRepo;
    private $shiftRepo;

    function __construct(
        MeritListInterface    $repo,
        ClassesInterface      $classRepo,
        ClassSetupInterface   $classSetupRepo,
        StudentInterface      $studentRepo,
        ExamTypeInterface     $examTypeRepo,
        ShiftInterface        $shiftRepo,
    )
    {
        $this->repo               = $repo;
        $this->classRepo          = $classRepo;
        $this->classSetupRepo     = $classSetupRepo;
        $this->studentRepo        = $studentRepo;
        $this->examTypeRepo       = $examTypeRepo;
        $this->shiftRepo          = $shiftRepo;
    }

    public function index()
    {
        $data['resultData']         = [];
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];
        $data['exam_types']         = [];
        $data['shifts']             = $this->shiftRepo->all();

        $title             = ___('common.Merit List');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['merit-list.search', 'class', 'section', 'exam_type', 'shift'],
            "create-permission"   => '',
            "create-route" => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Report"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.admin.report.merit-list', compact('data'));
    }

    public function search(MeritListRequest $request)
    {
        $data['resultData']   = $this->repo->search($request);
        $data['request']      = $request;
        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = $this->classSetupRepo->getSections($request->class);
        $data['exam_types']   = $this->examTypeRepo->all();
        $data['shifts']       = $this->shiftRepo->all();

        $title             = ___('common.Merit List');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['merit-list.search', 'class', 'section', 'exam_type', 'shift'],
            "create-permission"   => '',
            "create-route" => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Report"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.admin.report.merit-list', compact('data'));
    }



    public function generatePDF($type, $class, $section)
    {
        $request = new Request([
            'exam_type' => $type,
            'class'     => $class,
            'section'   => $section,
        ]);

        $data['resultData']   = $this->repo->searchPDF($request);

        $pdf = PDF::loadView('backend.admin.report.merit-listPDF', compact('data'));
        return $pdf->download('merit_list'.'_'.date('d_m_Y').'.pdf');
    }
}
