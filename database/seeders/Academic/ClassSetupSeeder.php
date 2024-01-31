<?php

namespace Database\Seeders\Academic;

use App\Models\Academic\Classes;
use App\Models\Academic\ClassSetup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = Classes::all();

        foreach ($classes as $class) {
            $row             = new ClassSetup();
            $row->session_id = 1;
            $row->classes_id   = $class->id;
            $row->save();
        }
    }
}
