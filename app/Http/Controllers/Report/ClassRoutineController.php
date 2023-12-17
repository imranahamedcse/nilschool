<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Report\ClassRoutineInterface;
use App\Http\Requests\Report\ClassRoutine\SearchRequest;
use PDF;

class ClassRoutineController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;

    function __construct(
        ClassRoutineInterface $repo,
        ClassesInterface      $classRepo,
        ClassSetupInterface   $classSetupRepo,
    )
    {
        $this->repo               = $repo;
        $this->classRepo          = $classRepo;
        $this->classSetupRepo     = $classSetupRepo;
    }

    public function index()
    {
        $title             = ___('common.Class routine');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['report-class-routine.search', 'class', 'section'],
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
        return view('backend.admin.report.class-routine', compact('data'));
    }

    public function search(SearchRequest $request)
    {
        $title             = ___('common.Class routine');
        $data['headers']   = [
            "title"        => $title,
            "filter"            => ['report-class-routine.search', 'class', 'section'],
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

        return view('backend.admin.report.class-routine', compact('data'));
    }

    public function generatePDF($class, $section)
    {
        $request = new Request([
            'class'        => $class,
            'section'      => $section
        ]);

        $data['result']       = $this->repo->search($request);
        $data['time']         = $this->repo->time($request);

        $pdf = PDF::loadView('backend.admin.report.class-routinePDF', compact('data'));
        return $pdf->download('class_routine'.'_'.date('d_m_Y').'.pdf');
    }
}
