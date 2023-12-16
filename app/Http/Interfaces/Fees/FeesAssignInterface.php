<?php

namespace App\Http\Interfaces\Fees;

interface FeesAssignInterface
{
    public function all();

    public function allActive();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function groupTypes($request);

    public function getFeesAssignStudents($request);
}
