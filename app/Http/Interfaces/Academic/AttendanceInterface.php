<?php

namespace App\Http\Interfaces\Academic;

interface AttendanceInterface
{

    public function attendance();

    public function store($request);

    public function searchStudents($request);

}
