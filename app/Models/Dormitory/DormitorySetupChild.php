<?php

namespace App\Models\Dormitory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitorySetupChild extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
