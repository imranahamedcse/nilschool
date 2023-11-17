<?php

namespace App\Repositories\StudentPanel;

use App\Interfaces\StudentPanel\ClassRoutineInterface;
use App\Models\StudentInfo\SessionClassStudent;
use App\Models\StudentInfo\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Academic\ClassRoutine;
use App\Models\Academic\ClassRoutineChildren;

class ClassRoutineRepository implements ClassRoutineInterface
{
    public function index()
    {
        try {
            $student        = Student::where('user_id', Auth::user()->id)->first();
            $classSection   = SessionClassStudent::where('session_id', setting('session'))->where('student_id', $student->id)->latest()->first();

            $request = new Request([
                'class'   => $classSection->classes_id,
                'section' => $classSection->section_id,
            ]);

            $data['result'] = ClassRoutine::where('classes_id', $request->class)->where('section_id', $request->section)->where('session_id', setting('session'))->orderBy('day')->get();
            $data['time']   = ClassRoutineChildren::whereHas('classRoutine', function($q) use($request){
                $q->where('classes_id', $request->class)->where('section_id', $request->section)->where('session_id', setting('session'));
            })
            ->orderBy('time_schedule_id')
            ->select('time_schedule_id')
            ->distinct()
            ->get();

            return $data;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
