<?php

namespace App\Http\Interfaces\Staff;

use Illuminate\Http\Request;

interface UserInterface
{

    public function index(Request $request);

    public function status(Request $request);

    public function deletes(Request $request);

    public function getAll();

    public function all();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function profileUpdate($request, $id);

    public function passwordUpdate($request, $id);

    public function destroy($id);
}
