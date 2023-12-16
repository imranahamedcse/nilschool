<?php

namespace App\Http\Interfaces\Report;

interface MeritListInterface
{
    public function search($request);

    public function searchPDF($request);
}
