<?php

namespace App\Repositories;

use App\Enums\Settings;
use App\Interfaces\GenderInterface;
use App\Models\Gender;
use App\Traits\ReturnFormatTrait;

class GenderRepository implements GenderInterface
{
    use ReturnFormatTrait;
    private $gender;

    public function __construct(Gender $gender)
    {
        $this->gender = $gender;
    }

    public function all()
    {
        return $this->gender->active()->get();
    }

    public function getAll()
    {
        return $this->gender->latest()->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        try {
            $genderStore              = new $this->gender;
            $genderStore->name        = $request->name;
            $genderStore->status      = $request->status;
            $genderStore->save();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function show($id)
    {
        return $this->gender->find($id);
    }

    public function update($request, $id)
    {
        try {
            $genderUpdate              = $this->gender->findOrfail($id);
            $genderUpdate->name        = $request->name;
            $genderUpdate->status      = $request->status;
            $genderUpdate->save();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        try {
            $genderDestroy = $this->gender->find($id);
            $genderDestroy->delete();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
