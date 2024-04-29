<?php

namespace App\Http\Interfaces\HumanResource;

interface StaffAttendanceInterface
{

    public function attendance();

    public function store($request);

    public function searchStaff($request);

}
