<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', \App\Enums\Status::ACTIVE);
    }
}
