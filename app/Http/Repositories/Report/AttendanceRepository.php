<?php

namespace App\Http\Repositories\Report;

use App\Http\Interfaces\Report\AttendanceInterface;
use App\Models\Attendance\Attendance;
use App\Traits\ReturnFormatTrait;

class AttendanceRepository implements AttendanceInterface
{
    use ReturnFormatTrait;

    private $model;

    public function __construct(Attendance $model)
    {
        $this->model  = $model;
    }

    public function searchReport($request)
    {
        $students = Attendance::query();

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
            $data['students']    = $students->paginate(10);
            return $data;
        } else {
            $data['students']    = $students->paginate(10);
            $data['attendances'] = [];
            return $data;
        }
    }

    public function searchReportPDF($request)
    {
        $students = Attendance::query();

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
            $data['students']    = $students->paginate(10);
            return $data;
        } else {
            $data['students']    = $students->get();
            $data['attendances'] = [];
            return $data;
        }
    }
}
