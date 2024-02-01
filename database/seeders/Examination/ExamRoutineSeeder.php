<?php

namespace Database\Seeders\Examination;

use Illuminate\Database\Seeder;
use App\Models\Academic\Classes;
use App\Models\Academic\ExamRoutine;
use App\Models\Academic\ExamRoutineChildren;
use App\Models\Academic\Section;
use App\Models\Examination\ExamType;

class ExamRoutineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $days = [
            1,
            2,
            3,
            4,
            5
        ];
        $classes  = Classes::all();
        $sections = Section::all();
        $types    = ExamType::all();

        foreach ($classes as $class) {
            foreach ($sections as $section) {
                foreach ($types as $type) {
                    foreach ($days as $day) {
                        $exam_routine              = new ExamRoutine();
                        $exam_routine->classes_id  = $class->id;
                        $exam_routine->section_id  = $section->id;
                        $exam_routine->session_id  = 1;
                        $exam_routine->type_id     = $type->id;
                        $exam_routine->date        = date("Y-m-d", strtotime("+ " . $day . " day"));
                        $exam_routine->save();

                        // class + date key wise subject id
                        $row                      = new ExamRoutineChildren();
                        $row->exam_routine_id     = $exam_routine->id;
                        $row->subject_id          = $day;
                        $row->time_schedule_id    = $day;
                        $row->class_room_id       = $day;
                        $row->save();
                    }
                }
            }
        }
    }
}
