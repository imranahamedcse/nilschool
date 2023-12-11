<?php

namespace App\Interfaces\Dormitory;

interface RoomInterface
{
    public function all();

    public function getAll();

    public function store($request);

    public function show($id);

    public function getRoom($id);

    public function update($request, $id);

    public function destroy($id);
}
