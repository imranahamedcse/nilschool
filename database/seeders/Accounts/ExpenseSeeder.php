<?php

namespace Database\Seeders\Accounts;

use App\Models\Accounts\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
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
                'name'           => 'Stationery Purchase',
                'expense_head'   => 4,
                'date'           => date('Y-m-d'),
                'invoice_number' => 466766,
                'amount'         => 800
            ],
            [
                'session_id'     => setting('session'),
                'name'           => 'Eectricity Bill',
                'expense_head'   => 5,
                'date'           => date('Y-m-d'),
                'invoice_number' => 445479,
                'amount'         => 580
            ],
            [
                'session_id'     => setting('session'),
                'name'           => 'Telephone Bill',
                'expense_head'   => 6,
                'date'           => date('Y-m-d'),
                'invoice_number' => 342312,
                'amount'         => 690
            ],

        ];

        foreach ($items as $item) {
            $row = new Expense();
            $row->session_id = $item['session_id'];
            $row->name = $item['name'];
            $row->expense_head = $item['expense_head'];
            $row->date = $item['date'];
            $row->invoice_number = $item['invoice_number'];
            $row->amount = $item['amount'];
            $row->save();
        }
    }
}
