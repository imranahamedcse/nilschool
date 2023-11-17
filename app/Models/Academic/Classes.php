<?php

namespace App\Models\Academic;

use App\Models\Academic\ClassSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', \App\Enums\Status::ACTIVE);
    }
    public function classSetup()
    {
        return $this->hasOne(ClassSetup::class);
    }
}
