<?php

namespace App\Http\Interfaces\Report;

interface AttendanceInterface
{

    public function attendance();

    public function store($request);

    public function searchStudents($request);

    public function searchReport($request);

    public function searchReportPDF($request);

}
