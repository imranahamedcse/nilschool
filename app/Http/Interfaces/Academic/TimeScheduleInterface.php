<?php

namespace App\Http\Interfaces\Academic;

interface TimeScheduleInterface
{

    public function all();

    public function allActive();

    public function allClassSchedule();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function allExamSchedule();
}
