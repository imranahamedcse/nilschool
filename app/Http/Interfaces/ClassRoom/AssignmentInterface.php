<?php

namespace App\Http\Interfaces\ClassRoom;

interface AssignmentInterface
{

    public function all();

    public function allActive();

    public function store($request);

    public function search($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
