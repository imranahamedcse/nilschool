<?php

namespace App\Models\WebsiteSetup;

use App\Models\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    public function upload()
    {
        return $this->belongsTo(Upload::class, 'upload_id', 'id');
    }

    public function icon_upload()
    {
        return $this->belongsTo(Upload::class, 'icon_upload_id', 'id');
    }
}
