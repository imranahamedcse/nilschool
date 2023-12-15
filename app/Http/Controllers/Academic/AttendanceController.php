<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Academic\AttendanceInterface;
use App\Http\Interfaces\Academic\ClassesInterface;
use App\Http\Interfaces\Academic\ClassSetupInterface;
use App\Http\Requests\Academic\Attendance\SearchRequest;
use Illuminate\Http\Request;
use PDF;

class AttendanceController extends Controller
{
    private $repo, $classRepo, $classSetupRepo;

    function __construct(
        AttendanceInterface   $repo,
        ClassesInterface      $classRepo,
        ClassSetupInterface   $classSetupRepo,
    ) {
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
            "filter"            => ['attendance.search', 'class', 'section', 'date'],
            "create-permission" => '',
            "create-route"      => '',
        ];

        return view('backend.admin.academic.attendance.index', compact('data'));
    }

    public function store(Request $request)
    {
        $result = $this->repo->store($request);
        if ($result['status']) {
            return redirect(route('attendance.index'))->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function searchStudents(SearchRequest $request)
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
            "filter"            => ['attendance.search', 'class', 'section', 'date'],
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
