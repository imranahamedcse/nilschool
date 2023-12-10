<?php

namespace App\Models\Transport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportSetup extends Model
{
    use HasFactory;

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }
    public function pickupPoints()
    {
        return $this->hasmany(TransportSetupPickupPoint::class, 'transport_setup_id', 'id');
    }
    public function vehicles()
    {
        return $this->hasmany(TransportSetupVehicle::class, 'transport_setup_id', 'id');
    }
}
