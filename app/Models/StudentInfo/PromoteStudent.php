<?php

namespace App\Models\StudentInfo;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoteStudent extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }
}
