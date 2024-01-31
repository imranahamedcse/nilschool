<?php

namespace Database\Seeders\Settings;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Islam',
            'Hindu',
            'Christian',
        ];

        foreach ($items as $item) {
            $row = new Religion();
            $row->name = $item;
            $row->save();
        }
    }
}
