<?php

namespace App\Repositories\Attendance;

use App\Enums\AttendanceType;
use App\Interfaces\Attendance\AttendanceInterface;
use App\Models\Attendance\Attendance;
use App\Traits\ReturnFormatTrait;
use Illuminate\Support\Facades\DB;
use App\Models\StudentInfo\SessionClassStudent;

class AttendanceRepository implements AttendanceInterface
{
    use ReturnFormatTrait;

    private $model;

    public function __construct(Attendance $model)
    {
        $this->model  = $model;
    }

    public function attendance(){
        $totalStudent = SessionClassStudent::where('session_id', setting('session'))->count();
        $data['present_student'] = $this->model->where('session_id', setting('session'))
                                    ->whereDay('date', date('d'))
                                    ->whereIn('attendance', [AttendanceType::PRESENT, AttendanceType::LATE, AttendanceType::HALFDAY])
                                    ->count();
        $data['absent_student'] = $totalStudent - $data['present_student'];
        return $data;
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->students as $key => $item) {

                if($request->status == 1)
                    $row = $this->model::find($request->items[$key]); // already submitted
                else
                $row = new $this->model; // new

                $row->session_id                = setting('session');
                $row->classes_id                = $request->class;
                $row->section_id                = $request->section;
                $row->roll                      = $request->studentsRoll[$key];
                $row->date                      = $request->date;
                $row->student_id                = $item;
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

    public function searchStudents($request)
    {
        $students = Attendance::where('session_id', setting('session'))
            ->where('classes_id', $request->class)
            ->where('section_id', $request->section)
            ->where('date', $request->date)
            ->get();

        $data['status'] = 1; // already submitted

        $ids = [];
        foreach ($students as $student) {
            $ids[] = $student->student_id;
        }

        if ($students->count() == 0) {
            $data['status'] = 0; // new
        }

        $students2 = SessionClassStudent::where('session_id', setting('session'))
            ->where('classes_id', $request->class)
            ->where('section_id', $request->section)
            ->whereNotIn('student_id', $ids)
            ->get();

        $data['students'] = $students->concat($students2);

        // dd($data);
        return $data;
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
            // dd($data);
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
            // dd($data);
            return $data;
        } else {
            $data['students']    = $students->get();
            $data['attendances'] = [];
            return $data;
        }
    }
}
