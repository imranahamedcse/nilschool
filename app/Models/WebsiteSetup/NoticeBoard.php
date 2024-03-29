<?php

namespace App\Models\WebsiteSetup;

use App\Models\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoard extends Model
{
    use HasFactory;

    protected $casts = [
        'visible_to' => 'array',
    ];

    public function upload()
    {
        return $this->belongsTo(Upload::class, 'attachment', 'id');
    }
}
