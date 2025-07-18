<?php

namespace App\Http\Repositories\Report;

use App\Http\Interfaces\Report\ExamRoutineInterface;
use App\Models\Academic\ExamRoutine;
use App\Models\Academic\ExamRoutineChildren;
use App\Traits\ReturnFormatTrait;

class ExamRoutineRepository implements ExamRoutineInterface
{
    use ReturnFormatTrait;

    public function search($request)
    {
        return ExamRoutine::where('classes_id', $request->class)->where('section_id', $request->section)->where('type_id', $request->exam_type)->where('session_id', setting('session'))->orderBy('date')->get();
    }

    public function time($request)
    {
        return ExamRoutineChildren::whereHas('examRoutine', function($q) use($request){
            $q->where('classes_id', $request->class)->where('section_id', $request->section)->where('type_id', $request->exam_type)->where('session_id', setting('session'));
        })
        ->orderBy('time_schedule_id')
        ->select('time_schedule_id')
        ->distinct()
        ->get();
    }
}
