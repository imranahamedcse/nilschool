<?php

namespace Database\Seeders\Transport;

use App\Models\Transport\Route;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Road One',
            'Road Two',
            'Road Three'
        ];

        foreach ($items as $item) {
            $row = new Route();
            $row->name = $item;
            $row->save();
        }
    }
}
