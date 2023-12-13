<?php

namespace App\Http\Interfaces\Dormitory;

interface DormitorySetupInterface
{
    public function getAll();

    public function store($request);

    public function show($id);

    public function getDormitoryRoom($id);

    public function update($request, $id);

    public function destroy($id);

    public function getRoom($id);
}
