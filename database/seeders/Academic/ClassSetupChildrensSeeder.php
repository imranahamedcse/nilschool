<?php

namespace Database\Seeders\Academic;

use App\Models\Academic\ClassSetup;
use App\Models\Academic\ClassSetupChildren;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSetupChildrensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = ClassSetup::all();
        $sections = [
            '1',
            '2'
        ];

        foreach ($classes as $class) {
            foreach ($sections as $section) {
                $row = new ClassSetupChildren();
                $row->class_setup_id = $class->id;
                $row->section_id = $section;
                $row->save();
            }
        }
    }
}
