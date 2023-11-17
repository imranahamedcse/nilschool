<?php

namespace App\Models\WebsiteSetup;

use App\Models\Upload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentContact extends Model
{
    use HasFactory;
    
    public function upload()
    {
        return $this->belongsTo(Upload::class, 'upload_id', 'id');
    }
}
