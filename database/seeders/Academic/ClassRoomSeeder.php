<?php

namespace Database\Seeders\Academic;

use App\Models\Academic\ClassRoom;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            '101',
            '102',
            '103',
            '104',
            '105',
        ];

        foreach ($items as $item) {
            $row = new ClassRoom();
            $row->room_no = $item;
            $row->capacity = 30;
            $row->save();
        }
    }
}
