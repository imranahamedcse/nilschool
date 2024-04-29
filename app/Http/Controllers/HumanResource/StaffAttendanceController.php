<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\HumanResource\DepartmentInterface;
use App\Http\Interfaces\HumanResource\StaffAttendanceInterface;
use App\Http\Requests\HumanResource\StaffAttendance\SearchRequest;
use Illuminate\Http\Request;
use PDF;

class StaffAttendanceController extends Controller
{
    private $repo, $departmentRepo;

    function __construct(
        StaffAttendanceInterface $repo,
        DepartmentInterface      $departmentRepo,
    ) {
        $this->repo              = $repo;
        $this->departmentRepo    = $departmentRepo;
    }

    public function index()
    {
        $data['title']        = ___('common.Staff Attendance');
        $data['departments']  = $this->departmentRepo->allActive();
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Human Resource"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['staff-attendance.search', 'department', 'date'],
            "create-permission" => '',
            "create-route"      => '',
        ];

        return view('backend.admin.human_resource.staff_attendance.index', compact('data'));
    }

    public function store(Request $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect(route('staff-attendance.index'))->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function searchStaff(SearchRequest $request)
    {
        $data = $this->repo->searchStaff($request);

        $data['title']    = ___('common.Staff Attendance');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Human Resource"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['staff-attendance.search', 'department', 'date'],
            "create-permission" => '',
            "create-route"      => '',
        ];

        $data['request']  = $request;
        $data['staffs'] = $data['staffs'];
        $data['departments']  = $this->departmentRepo->allActive();
        // dd($data);
        return view('backend.admin.human_resource.staff_attendance.index', compact('data'));
    }
}
