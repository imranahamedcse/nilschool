<?php

namespace Database\Seeders\Staff;

use App\Models\HumanResource\Designation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'HRM',
            'Admin',
            'Accounts',
            'Development',
            'Software'
        ];

        foreach ($items as $item) {
            $row = new Designation();
            $row->name = $item;
            $row->save();
        }
    }
}
