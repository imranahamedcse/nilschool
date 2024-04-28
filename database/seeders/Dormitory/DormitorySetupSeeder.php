<?php

namespace Database\Seeders\Dormitory;

use App\Models\Dormitory\DormitorySetup;
use App\Models\Dormitory\DormitorySetupChild;
use Illuminate\Database\Seeder;

class DormitorySetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'dormitory' => 1,
                'rooms' => [1],
            ],
            [
                'dormitory' => 2,
                'rooms' => [1, 2],
            ],
            [
                'dormitory' => 3,
                'rooms' => [1, 2, 3],
            ],
        ];

        foreach ($items as $item) {
            $row                   = new DormitorySetup();
            $row->dormitory_id     = $item['dormitory'];
            $row->save();

            foreach ($item['rooms'] as $key => $value) {
                $room = new DormitorySetupChild();
                $room->dormitory_setup_id = $row->id;
                $room->room_id = (int)$value;
                $room->save();
            }
        }
    }
}
