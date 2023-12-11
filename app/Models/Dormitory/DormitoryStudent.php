<?php

namespace App\Models\Dormitory;

use App\Models\StudentInfo\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitoryStudent extends Model
{
    use HasFactory;

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
