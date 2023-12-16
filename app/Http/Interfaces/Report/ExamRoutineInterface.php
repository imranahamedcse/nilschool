<?php

namespace App\Http\Interfaces\Report;

interface ExamRoutineInterface
{
    public function search($request);

    public function time($request);
}
