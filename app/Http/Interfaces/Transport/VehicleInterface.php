<?php

namespace App\Http\Interfaces\Transport;

interface VehicleInterface
{
    public function getAll();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
