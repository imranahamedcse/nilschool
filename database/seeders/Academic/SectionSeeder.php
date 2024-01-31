<?php

namespace Database\Seeders\Academic;

use App\Models\Academic\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'A',
            'B'
        ];

        foreach ($items as $item) {
            $row = new Section();
            $row->name = $item;
            $row->save();
        }
    }
}
