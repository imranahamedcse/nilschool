<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\AttendanceReportRequest;
use App\Http\Requests\Attendance\AttendanceSearchRequest;
use App\Http\Requests\Attendance\AttendanceStoreRequest;
use App\Http\Requests\Report\AttendanceRequest;
use App\Http\Repositories\Academic\ClassesRepository;
use App\Http\Repositories\Academic\ClassSetupRepository;
use App\Http\Repositories\Attendance\AttendanceRepository;
use Illuminate\Http\Request;
use PDF;

class AttendanceController extends Controller
{
    private $repo;
    private $classRepo;
    private $classSetupRepo;

    function __construct(
        AttendanceRepository   $repo,
        ClassesRepository      $classRepo, 
        ClassSetupRepository   $classSetupRepo, 
    )
    {
        $this->repo              = $repo;  
        $this->classRepo         = $classRepo; 
        $this->classSetupRepo    = $classSetupRepo; 
    }
    
    public function index()
    {
        $data['title']              = ___('attendance.Attendance');
        $data['classes']            = $this->classRepo->assignedAll();
        $data['sections']           = [];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Attendance"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['attendance.search', 'class', 'section','date'],
            "create-permission" => '',
            "create-route"      => '',
        ];

        return view('backend.admin.academic.attendance.index', compact('data'));
    }

    public function store(Request $request)
    {
        $result = $this->repo->store($request);
        if($result['status']){
            return redirect(route('attendance.index'))->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function searchStudents(AttendanceSearchRequest $request)
    {
        $data = $this->repo->searchStudents($request);

        $data['title']    = ___('attendance.Attendance');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Attendance"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['attendance.search', 'class', 'section','date'],
            "create-permission" => '',
            "create-route"      => '',
        ];

        $data['request']  = $request;
        $data['students'] = $data['students'];
        $data['status']   = $data['status'];
        $data['classes']  = $this->classRepo->assignedAll();
        $data['sections'] = $this->classSetupRepo->getSections($request->class);
        return view('backend.admin.academic.attendance.index', compact('data'));
    }
}
