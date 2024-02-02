<?php

namespace Database\Seeders\Academic;

use Illuminate\Database\Seeder;
use App\Models\Academic\Classes;
use App\Models\Academic\Subject;
use App\Models\Academic\ClassRoutine;
use App\Models\Academic\ClassRoutineChildren;
use App\Models\Academic\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassRoutineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            // 1, // Saturday
            2, // Sunday
            3, // Monday
            // 4, // Tuesday
            5, // Wednesday
            6, // Thursday
            // 7, // Friday
        ];
        $classes  = Classes::all();
        $sections = Section::all();
        $subjects = Subject::all();

        foreach ($days as $day) {
            foreach ($classes as $class) {
                foreach ($sections as $section) {
                    $class_routine             = new ClassRoutine();
                    $class_routine->classes_id = $class->id;

                    $class_routine->section_id = $section->id;
                    $class_routine->session_id = 1;

                    $class_routine->day        = $day;
                    $class_routine->save();

                    foreach ($subjects as $subject) {
                        $row                      = new ClassRoutineChildren();
                        $row->class_routine_id    = $class_routine->id;
                        $row->subject_id          = $subject->id;
                        $row->time_schedule_id    = $subject->id;
                        $row->class_room_id       = $subject->id;
                        $row->save();
                    }
                }
            }
        }
    }
}
