<?php

namespace App\Http\Interfaces\Examination;

interface ExamAssignInterface
{
    public function all();

    public function allActive();

    public function getExamType($request);

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function getSubjects($request);

    public function checkSubmit($request);

    public function getExamAssign($request);

    public function searchExamAssign($request);

    public function checkMarkRegister($id);

    public function assignedExamType();
}
