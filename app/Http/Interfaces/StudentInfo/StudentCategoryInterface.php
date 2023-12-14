<?php

namespace App\Http\Interfaces\StudentInfo;

interface StudentCategoryInterface
{
    public function allActive();

    public function all();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
