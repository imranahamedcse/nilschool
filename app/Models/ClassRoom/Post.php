<?php

namespace App\Models\ClassRoom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Academic\Classes;
use App\Models\Academic\Section;
use App\Models\Academic\Subject;
use App\Models\User;

class Post extends Model
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
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id');
    }
    public function comments()
    {
        return $this->hasmany(PostComment::class, 'post_id', 'id');
    }
}
