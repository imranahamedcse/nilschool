<?php

namespace Database\Seeders\Accounts;

use App\Models\Accounts\AccountHead;
use Illuminate\Database\Seeder;

class AccountHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [ // default row. don't remove this.
                'name' => 'Fees',
                'type' => 1
            ],
            [
                'name' => 'Donation',
                'type' => 1
            ],
            [
                'name' => 'Rent',
                'type' => 1
            ],
            [
                'name' => 'Book Sale',
                'type' => 1
            ],
            [
                'name' => 'Stationery Purchase',
                'type' => 2
            ],
            [
                'name' => 'Electricity Bill',
                'type' => 2
            ],
            [
                'name' => 'Telephone Bill',
                'type' => 2
            ],
        ];

        foreach ($items as $item) {
            $row = new AccountHead();
            $row->name = $item['name'];
            $row->type = $item['type'];
            $row->save();
        }
    }
}
