<?php

namespace Database\Seeders\Academic;

use App\Models\Academic\TimeSchedule;
use Illuminate\Database\Seeder;

class TimeScheduleSeeder extends Seeder
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
                'type'       => '1',
                'start_time' => '09:00',
                'end_time'   => '09:59',
            ],
            [
                'type'       => '1',
                'start_time' => '10:00',
                'end_time'   => '10:59',
            ],
            [
                'type'       => '1',
                'start_time' => '11:00',
                'end_time'   => '11:59',
            ],
            [
                'type'       => '1',
                'start_time' => '12:00',
                'end_time'   => '12:59',
            ],
            [
                'type'       => '1',
                'start_time' => '01:00',
                'end_time'   => '01:59',
            ],
            [
                'type'       => '2',
                'start_time' => '10:00',
                'end_time'   => '12:00',
            ],
        ];

        foreach ($items as $item) {
            $row = new TimeSchedule();
            $row->type = $item['type'];
            $row->start_time = $item['start_time'];
            $row->end_time = $item['end_time'];
            $row->save();
        }
    }
}
