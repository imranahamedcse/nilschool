<?php

namespace App\Interfaces\Transport;

interface RouteInterface
{
    public function getAll();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
