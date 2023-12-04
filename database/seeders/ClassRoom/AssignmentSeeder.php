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
        for ($i = 1; $i <= 3; $i++) {
            $row = new Assignment();
            $row->session_id = 1;
            $row->classes_id = $i;
            $row->section_id = 1;
            $row->subject_id = $i;
            $row->assigned_date = date('Y-m-d');
            $row->submission_date = date('Y-m-d');
            $row->mark = 10;
            $row->description = 'Test assignment description'. $i;
            $row->assigned_by = $i+1;
            $row->save();
        }
    }
}
