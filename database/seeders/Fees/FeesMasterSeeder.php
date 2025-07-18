<?php

namespace Database\Seeders\Fees;

use App\Models\Fees\FeesType;
use App\Models\Fees\FeesMaster;
use Illuminate\Database\Seeder;

class FeesMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = FeesType::all();

        foreach ($items as $item) {

            FeesMaster::create([
                'session_id'          => setting('session'),
                'fees_group_id'       => $item->id <= 5 ? 1 : 2,
                'fees_type_id'        => $item->id,
                'due_date'            => date('Y-m-d'),
                'amount'              => 1000,
                'fine_type'           => 0
            ]);
        }
    }
}
