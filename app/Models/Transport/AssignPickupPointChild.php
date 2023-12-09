<?php

namespace App\Models\Transport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignPickupPointChild extends Model
{
    use HasFactory;

    public function pickupPoint()
    {
        return $this->belongsTo(PickupPoint::class, 'pickup_point_id', 'id');
    }
}
