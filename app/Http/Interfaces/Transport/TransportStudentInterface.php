<?php

namespace App\Http\Interfaces\Transport;

interface TransportStudentInterface
{
    public function getAll();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
