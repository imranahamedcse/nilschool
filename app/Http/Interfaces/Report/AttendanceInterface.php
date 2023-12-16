<?php

namespace App\Http\Interfaces\Report;

interface AttendanceInterface
{
    public function searchReport($request);

    public function searchReportPDF($request);
}
