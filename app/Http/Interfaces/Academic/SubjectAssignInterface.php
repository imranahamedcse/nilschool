<?php

namespace App\Http\Interfaces\Academic;

interface SubjectAssignInterface
{

    public function all();

    public function allActive();

    public function store($request);

    public function getSubjects($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function checkSection($request);

    public function checkExamAssign($id);
}
