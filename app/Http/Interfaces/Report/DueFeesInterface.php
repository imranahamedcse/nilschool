<?php

namespace App\Http\Interfaces\Report;

interface DueFeesInterface
{
    public function search($request);
    public function assignedFeesTypes();
}
