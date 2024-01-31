<?php

namespace Database\Seeders\Examination;

use App\Models\Examination\MarksGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarkGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name'         => 'A+',
                'percent_from' => '80',
                'percent_upto' => '100',
                'point'        => '5.00',
                'remarks'      => 'A+',
                'session_id'   => setting('session')
            ],
            [
                'name'         => 'A',
                'percent_from' => '70',
                'percent_upto' => '79',
                'point'        => '4.5',
                'remarks'      => 'A',
                'session_id'   => setting('session')
            ],
            [
                'name'         => 'A-',
                'percent_from' => '60',
                'percent_upto' => '69',
                'point'        => '4.00',
                'remarks'      => 'A-',
                'session_id'   => setting('session')
            ],
            [
                'name'         => 'B',
                'percent_from' => '50',
                'percent_upto' => '59',
                'point'        => '3',
                'remarks'      => 'B',
                'session_id'   => setting('session')
            ],
            [
                'name'         => 'C',
                'percent_from' => '40',
                'percent_upto' => '49',
                'point'        => '2.00',
                'remarks'      => 'C',
                'session_id'   => setting('session')
            ],
            [
                'name'         => 'D',
                'percent_from' => '33',
                'percent_upto' => '39',
                'point'        => '1.00',
                'remarks'      => 'D',
                'session_id'   => setting('session')
            ],
            [
                'name'         => 'F',
                'percent_from' => '0',
                'percent_upto' => '32',
                'point'        => '0.00',
                'remarks'      => 'F',
                'session_id'   => setting('session')
            ],
        ];

        foreach ($items as $item) {
            $row               = new MarksGrade();
            $row->name         = $item['name'];
            $row->percent_from = $item['percent_from'];
            $row->percent_upto = $item['percent_upto'];
            $row->point        = $item['point'];
            $row->remarks      = $item['remarks'];
            $row->session_id   = $item['session_id'];
            $row->save();
        }
    }
}
