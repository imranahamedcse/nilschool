<?php

namespace App\Http\Interfaces\HumanResource;

interface DepartmentInterface
{

    public function all();

    public function allActive();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
