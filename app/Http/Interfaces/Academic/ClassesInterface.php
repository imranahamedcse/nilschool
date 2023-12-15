<?php

namespace App\Http\Interfaces\Academic;

interface ClassesInterface
{

    public function assignedAll();

    public function all();

    public function allActive();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
