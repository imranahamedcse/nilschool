<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory; 

    protected $fillable = [
        'name','start_date','end_date','status'
    ];
    
    public function scopeActive($query)
    {
        return $query->where('status', \App\Enums\Status::ACTIVE);
    }
}
