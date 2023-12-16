<?php

namespace App\Http\Interfaces\WebsiteSetup;

interface SliderInterface
{
    public function all();

    public function allActive();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);
}
