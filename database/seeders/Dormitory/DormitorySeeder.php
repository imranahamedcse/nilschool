<?php

namespace Database\Seeders\Dormitory;

use App\Models\Dormitory\Dormitory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DormitorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name'    => 'Dormitory A',
                'type'    => 'Boys',
                'address' => '123 Main St, City A, State A.',
            ],
            [
                'name'    => 'Dormitory B',
                'type'    => 'Girls',
                'address' => '456 Elm St, City B, State B.',
            ],
            [
                'name'    => 'Dormitory C',
                'type'    => 'Boys',
                'address' => '789 Oak St, City C, State C.',
            ],
        ];

        foreach ($items as $item) {
            $row                   = new Dormitory();
            $row->name             = $item['name'];
            $row->type             = $item['type'];
            $row->address          = $item['address'];
            $row->save();
        }
    }
}
