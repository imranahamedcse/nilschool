<?php

namespace App\Interfaces\Transport;

interface PickupPointInterface
{
    public function getAll();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
