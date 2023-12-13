<?php

namespace App\Http\Interfaces\StudentInfo;

interface PromoteStudentInterface
{

    public function all();

    public function getPaginateAll();

    public function search($request);

    public function store($request);
}
