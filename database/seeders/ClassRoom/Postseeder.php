<?php

namespace Database\Seeders\ClassRoom;

use App\Models\ClassRoom\Post;
use Illuminate\Database\Seeder;

class Postseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            "School Picnic",
            "Parent-Teacher Meeting",
            "Book Fair",
            "Science Exhibition",
            "Holiday Reminder"
        ];

        foreach ($items as $key => $item)  {
            $row = new Post();
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
