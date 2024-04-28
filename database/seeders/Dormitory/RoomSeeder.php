<?php

namespace Database\Seeders\Dormitory;

use App\Models\Dormitory\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'room_type_id' => 1,
                'room_no' => 101,
            ],
            [
                'room_type_id' => 2,
                'room_no' => 102,
            ],
            [
                'room_type_id' => 3,
                'room_no' => 103,
            ],
        ];

        foreach ($items as $item) {
            $row                = new Room();
            $row->room_type_id  = $item['room_type_id'];
            $row->room_no       = $item['room_no'];
            $row->save();
        }
    }
}
