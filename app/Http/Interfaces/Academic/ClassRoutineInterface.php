<?php

namespace App\Http\Interfaces\Academic;

interface ClassRoutineInterface
{

    public function all();

    public function allActive();

    public function store($request);

    public function getSubjects($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function checkClassRoutine($request);
}
