<?php

namespace App\Http\Interfaces\Examination;

interface ExamRoutineInterface
{

    public function all();

    public function allActive();

    public function store($request);

    public function getSubjects($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function checkExamRoutine($request);
}
