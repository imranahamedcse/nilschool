<?php

namespace Database\Seeders\Dormitory;

use App\Models\Dormitory\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Single',
                'total_seat' => 1,
                'seat_fee' => 1000,
            ],
            [
                'name' => 'Double',
                'total_seat' => 2,
                'seat_fee' => 600,
            ],
            [
                'name' => 'Triple',
                'total_seat' => 3,
                'seat_fee' => 400,
            ],
        ];

        foreach ($items as $item) {
            $row                   = new RoomType();
            $row->name             = $item['name'];
            $row->total_seat       = $item['total_seat'];
            $row->seat_fee         = $item['seat_fee'];
            $row->save();
        }
    }
}
