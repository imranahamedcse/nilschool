<?php

namespace App\Models\OnlineExamination;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerChildren extends Model
{
    use HasFactory;

    protected $casts = [
        'answer' => 'array',
    ];
}
