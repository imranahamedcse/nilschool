<?php

namespace App\Models\Fees;

use App\Models\StudentInfo\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesAssignStudents extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }


    public function feesAssignStudentsChilds()
    {
        return $this->hasMany(FeesAssignStudentsChilds::class, 'fees_assign_student_id', 'id');
    }
}
