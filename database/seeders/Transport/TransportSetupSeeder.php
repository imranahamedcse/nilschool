<?php

namespace Database\Seeders\Transport;

use App\Models\Transport\TransportSetup;
use App\Models\Transport\TransportSetupPickupPoint;
use App\Models\Transport\TransportSetupVehicle;
use Illuminate\Database\Seeder;

class TransportSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'route_id' => 1,
                'vehicle' => [1, 2],
                'pickup_point' => [1, 2],
            ],
            [
                'route_id' => 2,
                'vehicle' => [3, 4],
                'pickup_point' => [3, 4],
            ],
            [
                'route_id' => 3,
                'vehicle' => [5, 6, 7],
                'pickup_point' => [5, 6, 7],
            ],
        ];

        foreach ($items as $item) {
            $row                   = new TransportSetup();
            $row->route_id         = $item['route_id'];
            $row->save();

            foreach ($item['vehicle'] as $key => $value) {
                $vehicle = new TransportSetupVehicle();
                $vehicle->transport_setup_id = $row->id;
                $vehicle->vehicle_id = (int)$value;
                $vehicle->save();
            }

            foreach ($item['pickup_point'] as $key => $value) {
                $pickup_point = new TransportSetupPickupPoint();
                $pickup_point->transport_setup_id = $row->id;
                $pickup_point->pickup_point_id = (int)$value;
                $pickup_point->save();
            }
        }
    }
}
