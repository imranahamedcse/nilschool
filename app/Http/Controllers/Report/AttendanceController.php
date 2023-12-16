<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Interfaces\Report\AttendanceInterface;
use App\Http\Requests\Report\AttendanceRequest;
use Illuminate\Http\Request;
use PDF;

class AttendanceController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;

    function __construct(
        AttendanceInterface   $repo,
        ClassesInterface      $classRepo,
        ClassSetupInterface   $classSetupRepo,
    )
    {
        $this->repo              = $repo;
        $this->classRepo         = $classRepo;
        $this->classSetupRepo    = $classSetupRepo;
    }

    public function index()
    {
        $data['title']              = ___('attendance.Attendance');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Attendance"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['attendance.report-search', 'view', 'class', 'section', 'month', 'date'],
            "create-permission" => '',
            "create-route"      => '',
        ];

        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];
        $data['students']           = [];
        $data['request']            = [];

        return view('backend.admin.report.attendance', compact('data'));
    }


    public function reportSearch(AttendanceRequest $request)
    {
        $data['title']        = ___('attendance.Attendance');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Attendance"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['attendance.report-search', 'view', 'class', 'section', 'month', 'date'],
            "create-permission" => '',
            "create-route"      => '',
        ];

        $data['request']      = $request;
        $data['classes']      = $this->classRepo->assignedAll();
        $data['sections']     = $this->classSetupRepo->getSections($request->class);
        $results              = $this->repo->searchReport($request);
        $data['students']     = $results['students'];
        $data['days']         = $results['days'];
        $data['attendances']  = $results['attendances'];
        return view('backend.admin.report.attendance', compact('data'));
    }

    public function generatePDF(Request $request)
    {
        $results              = $this->repo->searchReportPDF($request);
        $data['students']     = $results['students'];
        $data['days']         = $results['days'];
        $data['attendances']  = $results['attendances'];
        $data['request']      = $request;

        $pdf = PDF::loadView('backend.admin.report.attendancePDF', compact('data'));

        if($request->view == '0')
            $pdf->setPaper('A4', 'landscape');

        return $pdf->download('attendance'.'_'.date('d_m_Y').'.pdf');
    }

}
