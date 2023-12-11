<?php

namespace Database\Seeders\Dormitory;

use App\Models\Dormitory\DormitoryStudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DormitoryStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'class' => 1,
                'section' => 1,
                'student' => 1,
                'dormitory' => 1,
                'room' => 1,
                'seat' => 1,
            ],
            [
                'class' => 1,
                'section' => 1,
                'student' => 2,
                'dormitory' => 2,
                'room' => 2,
                'seat' => 2,
            ],
            [
                'class' => 1,
                'section' => 1,
                'student' => 3,
                'dormitory' => 3,
                'room' => 3,
                'seat' => 3,
            ],
        ];

        foreach ($items as $item) {
            $row                   = new DormitoryStudent();
            $row->class_id         = $item['class'];
            $row->section_id       = $item['section'];
            $row->student_id       = $item['student'];
            $row->dormitory_id     = $item['dormitory'];
            $row->room_id          = $item['room'];
            $row->seat_no          = $item['seat'];
            $row->save();
        }
    }
}
