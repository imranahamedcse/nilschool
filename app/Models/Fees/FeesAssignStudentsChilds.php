<?php

namespace App\Models\Fees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fees\FeesAssign;
use App\Models\Fees\FeesMaster;
use App\Models\Fees\FeesCollect;

class FeesAssignStudentsChilds extends Model
{
    use HasFactory;

    public function FeesAssignStudent()
    {
        return $this->belongsTo(FeesAssignStudents::class, 'fees_assign_student_id', 'id');
    }
}
