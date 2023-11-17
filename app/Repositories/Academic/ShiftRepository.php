<?php

namespace App\Repositories\Academic;

use App\Enums\Settings;
use App\Interfaces\Academic\ShiftInterface;
use App\Models\Academic\Shift;
use App\Traits\ReturnFormatTrait;

class ShiftRepository implements ShiftInterface
{
    use ReturnFormatTrait;
    private $shift;

    public function __construct(Shift $shift)
    {
        $this->shift = $shift;
    }

    public function all()
    {
        return $this->shift->active()->get();
    }

    public function getAll()
    {
        return $this->shift->latest()->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        try {
            $shiftStore              = new $this->shift;
            $shiftStore->name        = $request->name;
            $shiftStore->status      = $request->status;
            $shiftStore->save();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function show($id)
    {
        return $this->shift->find($id);
    }

    public function update($request, $id)
    {
        try {
            $shiftUpdate              = $this->shift->findOrfail($id);
            $shiftUpdate->name        = $request->name;
            $shiftUpdate->status      = $request->status;
            $shiftUpdate->save();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        try {
            $shiftDestroy = $this->shift->find($id);
            $shiftDestroy->delete();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
