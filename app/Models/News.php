<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function upload()
    {
        return $this->belongsTo(Upload::class, 'upload_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
