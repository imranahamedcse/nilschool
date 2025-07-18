<?php

namespace Database\Seeders\Staff;

use App\Models\HumanResource\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'History',
            'Science',
            'Arch',
        ];

        foreach ($items as $item) {
            $row = new Department();
            $row->name = $item;
            $row->save();
        }
    }
}
