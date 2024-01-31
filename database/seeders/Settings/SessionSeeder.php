<?php

namespace Database\Seeders\Settings;

use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Session::create([
            'name'       => '2024',
            'start_date' => '2024-01-01',
            'end_date'   => '2024-12-31'
        ]);
        Session::create([
            'name'       => '2025',
            'start_date' => '2025-01-01',
            'end_date'   => '2025-12-31'
        ]);
        Session::create([
            'name'       => '2026',
            'start_date' => '2026-01-01',
            'end_date'   => '2026-12-31'
        ]);
    }
}
