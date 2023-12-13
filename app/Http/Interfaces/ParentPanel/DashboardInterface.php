<?php

namespace App\Http\Interfaces\ParentPanel;

interface DashboardInterface
{
    public function index();
    
    public function search($request);
}
