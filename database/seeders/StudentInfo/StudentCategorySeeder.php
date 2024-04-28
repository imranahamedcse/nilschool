<?php

namespace Database\Seeders\StudentInfo;

use App\Models\StudentInfo\StudentCategory;
use Illuminate\Database\Seeder;

class StudentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Regular',
            'Eregular'
        ];

        foreach ($items as $item) {
            $row = new StudentCategory();
            $row->name = $item;
            $row->save();
        }
    }
}
