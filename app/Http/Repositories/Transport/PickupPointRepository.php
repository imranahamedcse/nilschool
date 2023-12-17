<?php

namespace App\Http\Repositories\Transport;

use App\Enums\Settings;
use App\Http\Interfaces\Transport\PickupPointInterface;
use App\Models\Transport\PickupPoint;
use App\Traits\ReturnFormatTrait;

class PickupPointRepository implements PickupPointInterface
{
    use ReturnFormatTrait;
    private $head;

    public function __construct(PickupPoint $head)
    {
        $this->head = $head;
    }

    public function all()
    {
        return $this->head->active()->orderBy('name')->get();
    }
    public function getAll()
    {
        return $this->head->latest()->get();
    }

    public function store($request)
    {
        try {
            $headStore                   = new $this->head;
            $headStore->name             = $request->name;
            $headStore->fee              = $request->fee;
            $headStore->status           = $request->status;
            $headStore->save();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function show($id)
    {
        return $this->head->find($id);
    }

    public function update($request, $id)
    {
        try {
            $headUpdate                   = $this->head->findOrfail($id);
            $headUpdate->name             = $request->name;
            $headUpdate->fee              = $request->fee;
            $headUpdate->status           = $request->status;
            $headUpdate->save();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        try {
            $headDestroy = $this->head->find($id);
            $headDestroy->delete();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
