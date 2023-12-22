<?php

namespace App\Http\Controllers\ParentPanel;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ParentPanel\AttendanceRepository;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $repo;

    function __construct(  AttendanceRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $data                       = $this->repo->index();
        $data['results']            = [];

        $data['title']              = ___('common.Attendance');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['parent-panel-attendance.search', 'view', 'month', 'date'],
        ];

        return view('backend.parent.attendance', compact('data'));
    }

    public function search(Request $request)
    {
        $data                 = $this->repo->search($request);
        $data['request']      = $request;

        $data['title']              = ___('common.Attendance');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['headers']  = [
            "title"             => $data['title'],
            "filter"            => ['parent-panel-attendance.search', 'view', 'month', 'date'],
        ];

        return view('backend.parent.attendance', compact('data'));
    }
}
