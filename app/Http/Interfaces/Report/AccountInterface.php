<?php

namespace App\Http\Interfaces\Report;

interface AccountInterface
{
    public function search($request);

    public function searchPDF($request);
}
