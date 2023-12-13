<?php

namespace App\Http\Interfaces\Accounts;

interface IncomeInterface
{

    public function all();

    public function getAll();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
