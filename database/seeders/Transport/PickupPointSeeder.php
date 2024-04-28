<?php

namespace Database\Seeders\Transport;

use App\Models\Transport\PickupPoint;
use Illuminate\Database\Seeder;

class PickupPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Point1',
                'fee' => 5.00,
                'description' => 'Standard pickup point with a small fee.'
            ],
            [
                'name' => 'Point2',
                'fee' => 8.50,
                'description' => 'Premium pickup point with a higher fee for added services.'
            ],
            [
                'name' => 'Point3',
                'fee' => 3.00,
                'description' => 'Economy pickup point with a lower fee.'
            ],
            [
                'name' => 'Point4',
                'fee' => 6.50,
                'description' => 'Central pickup point with a moderate fee.'
            ],
            [
                'name' => 'Point5',
                'fee' => 4.00,
                'description' => 'Local pickup point with a reasonable fee.'
            ],
            [
                'name' => 'Point6',
                'fee' => 7.00,
                'description' => 'Exclusive pickup point with premium services.'
            ],
            [
                'name' => 'Point7',
                'fee' => 2.50,
                'description' => 'Budget pickup point with a minimal fee.'
            ],
            [
                'name' => 'Point8',
                'fee' => 9.00,
                'description' => 'Luxury pickup point with a higher fee for VIP treatment.'
            ],
            [
                'name' => 'Point9',
                'fee' => 3.50,
                'description' => 'Neighborhood pickup point with a modest fee.'
            ],
            [
                'name' => 'Point10',
                'fee' => 6.00,
                'description' => 'Efficient pickup point with a competitive fee.'
            ],
            [
                'name' => 'Point11',
                'fee' => 5.75,
                'description' => 'Suburban pickup point with a convenient fee.'
            ],
            [
                'name' => 'Point12',
                'fee' => 4.25,
                'description' => 'Affordable pickup point with reasonable services.'
            ],
            [
                'name' => 'Point13',
                'fee' => 8.00,
                'description' => 'Exclusive downtown pickup point with premium features.'
            ],
            [
                'name' => 'Point14',
                'fee' => 3.75,
                'description' => 'Compact pickup point with a moderate fee.'
            ],
            [
                'name' => 'Point15',
                'fee' => 7.50,
                'description' => 'Executive pickup point with enhanced services.'
            ],
        ];

        foreach ($items as $item) {
            $row = new PickupPoint();
            $row->name = $item['name'];
            $row->fee = $item['fee'];
            $row->description = $item['description'];
            $row->save();
        }
    }
}
