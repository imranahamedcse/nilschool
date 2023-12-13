<?php

namespace App\Http\Interfaces\Frontend;

interface FrontendInterface
{
    public function sliders();
    public function counters();
    public function newsDetail($id);
}
