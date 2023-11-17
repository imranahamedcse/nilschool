<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    
    public function upload()
    {
        return $this->belongsTo(Upload::class, 'upload_id', 'id');
    }
}
