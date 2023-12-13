<?php

namespace App\Http\Interfaces\Transport;

interface TransportSetupInterface
{
    public function getAll();

    public function store($request);

    public function show($id);
    
    public function getTransport($id);

    public function update($request, $id);

    public function destroy($id);
}
