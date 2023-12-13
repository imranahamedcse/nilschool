<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Report\FeesCollectionRequest;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\StudentInfo\StudentRepository;
use App\Http\Repositories\Examination\ExamAssignRepository;
use App\Http\Repositories\Report\FeesCollectionRepository;
use App\Http\Repositories\Report\MeritListRepository;
use Illuminate\Support\Facades\Crypt;
use PDF;

class FeesCollectionController extends Controller
{
    private $repo;
    private $examAssignRepo;
    private $classRepo;
    private $classSetupRepo;
    private $studentRepo;

    function __construct(
        FeesCollectionRepository    $repo,
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
        $title             = ___('student_info.Fees collection');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['fees-collection.search', 'class', 'section', 'date_range'],
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
        return view('backend.admin.report.fees-collection', compact('data'));
    }

    public function search(FeesCollectionRequest $request)
    {
        $title             = ___('student_info.Fees collection');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['fees-collection.search', 'class', 'section', 'date_range'],
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
        $data['sections']     = $this->classSetupRepo->getSections($request->class);
        return view('backend.admin.report.fees-collection', compact('data'));
    }
    
    public function generatePDF($class, $section, $dates)
    {
        $request = new Request([
            'class'        => $class,
            'section'      => $section,
            'dates'        => Crypt::decryptString($dates),
        ]);

        $data['result']       = $this->repo->searchPDF($request);
        
        $pdf = PDF::loadView('backend.admin.report.fees-collectionPDF', compact('data'));
        return $pdf->download('fees_collection'.'_'.date('d_m_Y').'.pdf');
    }
}
