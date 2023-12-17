<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Report\DueFeesInterface;
use App\Http\Requests\Report\DueFeesRequest;
use PDF;

class DueFeesController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;

    function __construct(
        DueFeesInterface    $repo,
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
        $title             = ___('common.Due fees');
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
        $title             = ___('common.Due fees');
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
