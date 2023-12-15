<?php

namespace App\Http\Interfaces\StudentInfo;

interface ParentGuardianInterface
{

    public function all();

    public function allActive();

    public function searchParent($request);

    public function getParent($request);

    public function store($request);

    public function studentStore($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
