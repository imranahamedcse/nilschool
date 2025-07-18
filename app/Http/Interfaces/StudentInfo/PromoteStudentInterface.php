<?php

namespace App\Http\Interfaces\StudentInfo;

interface PromoteStudentInterface
{

    public function allActive();

    public function all();

    public function search($request);

    public function store($request);

    public function getClass($request);

    public function getSections($request);
}
