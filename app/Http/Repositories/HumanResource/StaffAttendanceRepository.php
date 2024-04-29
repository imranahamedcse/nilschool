<?php

namespace App\Http\Repositories\HumanResource;

use App\Enums\AttendanceType;
use App\Http\Interfaces\HumanResource\StaffAttendanceInterface;
use App\Models\HumanResource\Staff;
use App\Models\HumanResource\StaffAttendance;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;

class StaffAttendanceRepository implements StaffAttendanceInterface
{
    use ReturnFormatTrait;

    private $model;

    public function __construct(StaffAttendance $model)
    {
        $this->model  = $model;
    }

    public function attendance(){
        $totalStaff = Staff::count();
        $data['present_staff'] = $this->model->whereDay('date', date('d'))
                                    ->whereIn('attendance', [AttendanceType::PRESENT, AttendanceType::LATE, AttendanceType::HALFDAY])
                                    ->count();
        $data['absent_student'] = $totalStaff - $data['present_staff'];
        return $data;
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->staffs as $key => $item) {

                if($request->status == 1)
                    $row = $this->model::find($request->items[$key]); // already submitted
                else
                $row = new $this->model; // new

                $row->session_id                = setting('session');
                $row->department_id             = $request->department;
                $row->date                      = $request->date;
                $row->staff_id                  = $item;
                if ($request->holiday == "on")
                    $row->attendance            = 0;
                else
                    $row->attendance            = $request->attendance[$item];
                $row->note                      = $request->note[$key];
                $row->save();
            }
            DB::commit();
            return $this->responseWithSuccess(___('alert.submitted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function searchStaff($request)
    {
        $staffs = StaffAttendance::where('session_id', setting('session'))
            ->where('department_id', $request->department)
            ->where('date', $request->date)
            ->get();

        $data['status'] = 1; // already submitted

        $ids = [];
        foreach ($staffs as $staff) {
            $ids[] = $staff->staff_id;
        }

        if ($staffs->count() == 0) {
            $data['status'] = 0; // new
        }

        $staffs2 = Staff::where('department_id', $request->department)
            ->whereNotIn('id', $ids)
            ->get();

        $data['staffs'] = $staffs->concat($staffs2);
        
        return $data;
    }

    public function searchReport($request)
    {
        $students = StaffAttendance::query();

        $students = $students->where('session_id', setting('session'));
        if ($request->month != "") {
            $students = $students->where('date', 'LIKE', $request->month . '%');
        }
        if ($request->date != "") {
            $students = $students->where('date', $request->date);
        }

        $year = 0;
        $month = 0;
        if ($request->month != "") {
            $abc = explode('-', $request->month);
            $year = $abc[0];
            $month = $abc[1];
        }


        if ($request->date != "") {
            $abc   = explode('-', $request->date);
            $year  = $abc[0];
            $month = $abc[1];
        }


        $data['days'] = getAllDaysInMonth($year, $month);

        if ($request->view == 0) {
            $students->select('student_id', 'date', 'attendance');
            $data['attendances'] = $students->get();
            $students->select('student_id', 'roll')->distinct('student_id');
            $data['students']    = $students->get();
            return $data;
        } else {
            $data['students']    = $students->get();
            $data['attendances'] = [];
            return $data;
        }
    }

    public function searchReportPDF($request)
    {
        $students = StaffAttendance::query();

        $students = $students->where('session_id', setting('session'));
        if ($request->class != "") {
            $students = $students->where('classes_id', $request->class);
        }
        if ($request->section != "") {
            $students = $students->where('section_id', $request->section);
        }
        if ($request->month != "") {
            $students = $students->where('date', 'LIKE', $request->month . '%');
        }
        if ($request->date != "") {
            $students = $students->where('date', $request->date);
        }
        if ($request->roll != "") {
            $students = $students->where('roll', $request->roll);
        }

        $year = 0;
        $month = 0;
        if ($request->month != "") {
            $abc = explode('-', $request->month);
            $year = $abc[0];
            $month = $abc[1];
        }


        if ($request->date != "") {
            $abc   = explode('-', $request->date);
            $year  = $abc[0];
            $month = $abc[1];
        }


        $data['days'] = getAllDaysInMonth($year, $month);

        if ($request->view == 0) {
            $students->select('student_id', 'date', 'attendance');
            $data['attendances'] = $students->get();
            $students->select('student_id', 'roll')->distinct('student_id');
            $data['students']    = $students->get();
            return $data;
        } else {
            $data['students']    = $students->get();
            $data['attendances'] = [];
            return $data;
        }
    }
}
