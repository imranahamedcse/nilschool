<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Academic\TimeSchedule\TimeScheduleStoreRequest;
use App\Http\Requests\Academic\TimeSchedule\TimeScheduleUpdateRequest;
use App\Http\Interfaces\Academic\TimeScheduleInterface;
use Illuminate\Support\Facades\Schema;

class TimeScheduleController extends Controller
{
    private $timeRepo;

    function __construct(TimeScheduleInterface $timeRepo)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')) {
            abort(400);
        }
        $this->timeRepo       = $timeRepo;
    }

    public function index()
    {
        $data['time_schedule'] = $this->timeRepo->getAll();

        $title = ___('academic.time_schedule');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'time_schedule_create',
            "create-route" => 'time_schedule.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];

        return view('backend.admin.academic.time-schedule.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('academic.Add time schedule');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Time schedule"), "route" => "time_schedule.index"],
            ["title" => $data['title'], "route" => ""]
        ];
        
        return view('backend.admin.academic.time-schedule.create', compact('data'));
    }

    public function store(TimeScheduleStoreRequest $request)
    {
        $result = $this->timeRepo->store($request);
        if ($result['status']) {
            return redirect()->route('time_schedule.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']        = ___('academic.Edit time schedule');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Academic"), "route" => ""],
            ["title" => ___("common.Time schedule"), "route" => "time_schedule.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['time_schedule']        = $this->timeRepo->show($id);
        return view('backend.admin.academic.time-schedule.edit', compact('data'));
    }

    public function update(TimeScheduleUpdateRequest $request, $id)
    {
        $result = $this->timeRepo->update($request, $id);
        if ($result['status']) {
            return redirect()->route('time_schedule.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->timeRepo->destroy($id);
        if ($result['status']) :
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else :
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;
    }
}
