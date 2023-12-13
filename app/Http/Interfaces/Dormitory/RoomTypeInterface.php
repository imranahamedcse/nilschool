<?php

namespace App\Http\Interfaces\Dormitory;

interface RoomTypeInterface
{
    public function getAll();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
