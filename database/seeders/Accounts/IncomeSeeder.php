<?php

namespace Database\Seeders\Accounts;

use App\Models\Accounts\Income;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'session_id'     => setting('session'),
                'name'           => 'School Donation',
                'income_head'    => 2,
                'date'           => date('Y-m-d'),
                'invoice_number' => 466466,
                'amount'         => 852
            ],
            [
                'session_id'     => setting('session'),
                'name'           => 'School Rent',
                'income_head'    => 3,
                'date'           => date('Y-m-d'),
                'invoice_number' => 446479,
                'amount'         => 741
            ],
            [
                'session_id'     => setting('session'),
                'name'           => 'School Book Sale	',
                'income_head'    => 4,
                'date'           => date('Y-m-d'),
                'invoice_number' => 332312,
                'amount'         => 963
            ],

        ];

        foreach ($items as $item) {
            $row = new Income();
            $row->session_id = $item['session_id'];
            $row->name = $item['name'];
            $row->income_head = $item['income_head'];
            $row->date = $item['date'];
            $row->invoice_number = $item['invoice_number'];
            $row->amount = $item['amount'];
            $row->save();
        }
    }
}
