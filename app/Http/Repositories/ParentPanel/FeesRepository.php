<?php

namespace App\Http\Repositories\ParentPanel;

use App\Enums\Settings;
use App\Models\StudentInfo\Student;
use Illuminate\Support\Facades\Auth;
use App\Models\Fees\FeesAssignChildren;
use App\Models\StudentInfo\ParentGuardian;
use App\Http\Interfaces\ParentPanel\FeesInterface;
use Illuminate\Support\Facades\Session;

class FeesRepository implements FeesInterface
{
    public function index()
    {
        try {
            $parent                 = ParentGuardian::where('user_id', Auth::user()->id)->first();
            $data['students']       = Student::where('parent_guardian_id', $parent->id)->get();
            $data['fees_assigned']  = [];

            if (Session::get('student_id')) {
                $data['fees_assigned']  = FeesAssignChildren::withCount('feesCollect')->with('feesCollect')
                                        ->where('student_id', Session::get('student_id'))
                                        ->whereHas('feesAssign', function ($query) {
                                            return $query->where('session_id', setting('session'));
                                        })
                                        ->get();
            }

            return $data;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
