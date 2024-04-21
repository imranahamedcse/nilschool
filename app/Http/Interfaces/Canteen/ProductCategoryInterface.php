<?php

namespace App\Http\Interfaces\Canteen;

interface ProductCategoryInterface
{
    public function all();

    public function getAll();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
