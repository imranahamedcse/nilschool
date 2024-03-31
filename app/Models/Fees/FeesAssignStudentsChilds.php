<?php

namespace App\Models\Fees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesAssignStudentsChilds extends Model
{
    use HasFactory;

    public function feesAssignStudent()
    {
        return $this->belongsTo(FeesAssignStudents::class, 'fees_assign_student_id', 'id');
    }

    public function feesType()
    {
        return $this->belongsTo(FeesType::class, 'fees_type_id', 'id');
    }
}
