<?php

namespace App\Http\Interfaces\Report;

interface FeesCollectionInterface
{
    public function search($request);

    public function searchPDF($request);
}
