<?php

namespace App\Models\WebsiteSetup;

use App\Models\Academic\Classes;
use App\Models\Academic\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlineAdmission extends Model
{
    use HasFactory;

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classes_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
