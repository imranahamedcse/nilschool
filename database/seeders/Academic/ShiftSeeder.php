<?php

namespace Database\Seeders\Academic;

use App\Models\Academic\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Day',
            'Night'
        ];

        foreach ($items as $item) {
            $row = new Shift();
            $row->name = $item;
            $row->save();
        }
    }
}
