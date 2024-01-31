<?php

namespace Database\Seeders\Academic;

use App\Models\Academic\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'One',
            'Two',
            'Three',
            'Four',
            'Five'
        ];

        foreach ($items as $item) {
            $row = new Classes();
            $row->name = $item;
            $row->save();
        }
    }
}
