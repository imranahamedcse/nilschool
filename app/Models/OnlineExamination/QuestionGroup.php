<?php

namespace App\Models\OnlineExamination;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionGroup extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'session_id','name','status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', \App\Enums\Status::ACTIVE);
    }
    public function scopeLatest($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
