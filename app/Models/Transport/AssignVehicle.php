<?php

namespace App\Models\Transport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignVehicle extends Model
{
    use HasFactory;

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }
    public function pickupPoints()
    {
        return $this->hasmany(AssignPickupPointChild::class, 'assign_vehicle_id', 'id');
    }
    public function vehicles()
    {
        return $this->hasmany(AssignVehicleChild::class, 'assign_vehicle_id', 'id');
    }
}
