<?php

namespace Database\Seeders\ClassRoom;

use App\Models\ClassRoom\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Postseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            $row = new Post();
            $row->session_id = 1;
            $row->classes_id = $i;
            $row->section_id = 1;
            $row->subject_id = $i;
            $row->description = 'Test post description'. $i;
            $row->assigned_by = $i+1;
            $row->save();
        }
    }
}
