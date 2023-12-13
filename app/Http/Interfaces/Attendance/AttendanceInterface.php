<?php

namespace App\Http\Interfaces\Attendance;

interface AttendanceInterface
{

    public function attendance();

    public function store($request);

    public function searchStudents($request);

}
