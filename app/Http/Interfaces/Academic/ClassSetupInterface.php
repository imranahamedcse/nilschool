<?php

namespace App\Http\Interfaces\Academic;

interface ClassSetupInterface
{

    public function getSections($id);

    public function all();

    public function allActive();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function destroy($id);

    public function promoteClasses($id);
    
    public function promoteSections($session_id, $classes_id);
}
