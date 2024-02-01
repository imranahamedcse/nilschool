<?php

namespace Database\Seeders\ClassRoom;

use App\Models\ClassRoom\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            "Colorful Candy Collection",
            "Zoo Adventure",
            "Superhero Team-Up",
            "Space Explorer's Log",
            "Recipe Book Reimagined"
        ];

        foreach ($items as $key => $item)  {
            $row = new Assignment();
            $row->session_id = 1;
            $row->classes_id = $key+1;
            $row->section_id = 1;
            $row->subject_id = $key+1;
            $row->assigned_date = date('Y-m-d');
            $row->submission_date = date('Y-m-d');
            $row->mark = 10;
            $row->description = $item;
            $row->assigned_by = $key+2;
            $row->save();
        }
    }
}
