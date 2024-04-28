<?php

namespace Database\Seeders\ClassRoom;

use App\Models\ClassRoom\Homework;
use Illuminate\Database\Seeder;

class HomeworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            "Counting Critters",
            "Storybook Adventure",
            "Inventor's Challenge",
            "Explorer's Logbook",
            "Environmental Advocacy"
        ];


        foreach ($items as $key => $item)  {
            $row = new Homework();
            $row->session_id = 1;
            $row->classes_id = $key+1;
            $row->section_id = 1;
            $row->subject_id = $key+1;
            $row->description = $item;
            $row->assigned_by = $key+2;
            $row->save();
        }
    }
}
