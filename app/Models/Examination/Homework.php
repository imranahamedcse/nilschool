<?php

namespace App\Models\Examination;

use App\Models\Academic\Classes;
use App\Models\Academic\Section;
use App\Models\Academic\Subject;
use App\Models\Examination\ExamType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Homework extends Model
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
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
