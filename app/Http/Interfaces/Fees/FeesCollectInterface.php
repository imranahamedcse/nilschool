<?php

namespace App\Http\Interfaces\Fees;

interface FeesCollectInterface
{
    public function all();

    public function allActive();

    public function store($request);

    public function show($id);

    public function feesAssigned($id);

    public function update($request, $id);

    public function destroy($id);

    public function getFeesAssignStudents($request);

    public function feesShow($request);

}
