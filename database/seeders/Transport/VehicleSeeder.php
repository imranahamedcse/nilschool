<?php

namespace Database\Seeders\Transport;

use App\Models\Transport\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Car1',
                'license_no' => 'ABC123',
                'driver_name' => 'John Doe',
                'driver_phone' => '123-456-7890',
                'description' => 'A sleek black sedan.'
            ],
            [
                'name' => 'Truck1',
                'license_no' => 'XYZ789',
                'driver_name' => 'Jane Smith',
                'driver_phone' => '987-654-3210',
                'description' => 'A sturdy red truck for transporting goods.'
            ],
            [
                'name' => 'Van1',
                'license_no' => 'PQR456',
                'driver_name' => 'Alice Johnson',
                'driver_phone' => '555-123-4567',
                'description' => 'A white van for deliveries.'
            ],
            [
                'name' => 'Motorcycle1',
                'license_no' => 'MNO789',
                'driver_name' => 'Bob Williams',
                'driver_phone' => '789-321-6540',
                'description' => 'A fast and agile motorcycle.'
            ],
            [
                'name' => 'Bus1',
                'license_no' => 'LMN234',
                'driver_name' => 'Charlie Brown',
                'driver_phone' => '222-333-4444',
                'description' => 'A large bus for group transportation.'
            ],
            [
                'name' => 'Scooter1',
                'license_no' => 'JKL567',
                'driver_name' => 'Eva Davis',
                'driver_phone' => '666-777-8888',
                'description' => 'A convenient electric scooter.'
            ],
            [
                'name' => 'Tractor1',
                'license_no' => 'GHI890',
                'driver_name' => 'Sam Green',
                'driver_phone' => '999-000-1111',
                'description' => 'A powerful tractor for agricultural use.'
            ],
            [
                'name' => 'Bicycle1',
                'license_no' => 'DEF345',
                'driver_name' => 'Tom Wilson',
                'driver_phone' => '444-555-6666',
                'description' => 'A simple and eco-friendly bicycle.'
            ],
            [
                'name' => 'Helicopter1',
                'license_no' => 'UVW123',
                'driver_name' => 'Olivia Turner',
                'driver_phone' => '111-222-3333',
                'description' => 'A helicopter for aerial transportation.'
            ]
        ];

        foreach ($items as $item) {
            $row = new Vehicle();
            $row->name = $item['name'];
            $row->license_no = $item['license_no'];
            $row->driver_name = $item['driver_name'];
            $row->driver_phone = $item['driver_phone'];
            $row->description = $item['description'];
            $row->save();
        }
    }
}
