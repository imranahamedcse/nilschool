<?php

namespace App\Http\Interfaces\HumanResource;

use Illuminate\Http\Request;

interface StaffInterface
{

    public function index(Request $request);

    public function status(Request $request);

    public function deletes(Request $request);

    public function allActive();

    public function all();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function profileUpdate($request, $id);

    public function passwordUpdate($request, $id);

    public function destroy($id);
}
