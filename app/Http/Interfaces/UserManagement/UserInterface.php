<?php

namespace App\Http\Interfaces\UserManagement;

use Illuminate\Http\Request;

interface UserInterface
{
    public function allActive();

    public function all();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
