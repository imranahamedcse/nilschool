<?php

namespace Database\Seeders\Settings;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Male',
            'Female',
            'Other',
        ];

        foreach ($items as $item) {
            $row = new Gender();
            $row->name = $item;
            $row->save();
        }
    }
}
