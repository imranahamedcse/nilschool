<?php

namespace App\Models\Dormitory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitorySetup extends Model
{
    use HasFactory;

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id', 'id');
    }

    public function rooms()
    {
        return $this->hasmany(DormitorySetupChild::class, 'dormitory_setup_id', 'id');
    }
}
