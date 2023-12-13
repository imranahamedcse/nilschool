<?php

namespace App\Http\Interfaces\Settings;

interface LanguageInterface
{

    public function all();

    public function getAll();

    public function store($request);

    public function show($id);

    public function update($request,$id);

    public function destroy($id);

    public function terms($id);

    public function termsUpdate($request, $code);

}
