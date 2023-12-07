<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Report\DueFeesRequest;
use App\Repositories\Academic\ClassesRepository;
use App\Repositories\Academic\ClassSetupRepository;
use App\Repositories\StudentInfo\StudentRepository;
use App\Repositories\Examination\ExamAssignRepository;
use App\Repositories\Report\DueFeesRepository;
use App\Repositories\Report\MeritListRepository;
use PDF;

class DueFeesController extends Controller
{
    private $repo;
    private $examAssignRepo;
    private $classRepo;
    private $classSetupRepo;
    private $studentRepo;

    function __construct(
        DueFeesRepository    $repo,
        ExamAssignRepository   $examAssignRepo,
        ClassesRepository      $classRepo,
        ClassSetupRepository   $classSetupRepo,
        StudentRepository      $studentRepo,
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
        $title             = ___('student_info.Due fees');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['due-fees.search', 'class', 'section', 'fees'],
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
        $data['fees_masters']       = $this->repo->assignedFeesTypes();
        
        return view('backend.admin.report.due-fees', compact('data'));
    }

    public function search(DueFeesRequest $request)
    {
        $title             = ___('student_info.Due fees');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['due-fees.search', 'class', 'section', 'fees'],
            "create-permission"   => '',
            "create-route" => '',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Report"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        
        $data['result']       = $this->repo->search($request);
        $data['request']      = $request;
        $data['classes']      = $this->classRepo->assignedAll();
        $data['fees_masters'] = $this->repo->assignedFeesTypes();
        $data['sections']     = $this->classSetupRepo->getSections($request->class);
        return view('backend.admin.report.due-fees', compact('data'));
    }
    
    public function generatePDF(Request $request)
    {
        $request = new Request([
            'class'        => $request->class,
            'section'      => $request->section,
            'fees_master'  => $request->type,
        ]);

        $data['result']       = $this->repo->searchPDF($request);
        
        $pdf = PDF::loadView('backend.admin.report.due-feesPDF', compact('data'));
        return $pdf->download('due_fees'.'_'.date('d_m_Y').'.pdf');
    }
}
