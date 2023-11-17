<?php

namespace App\Repositories\Academic;

use App\Enums\Settings;
use App\Interfaces\Academic\SectionInterface;
use App\Models\Academic\Section;
use App\Traits\ReturnFormatTrait;

class SectionRepository implements SectionInterface
{
    use ReturnFormatTrait;
    private $section;

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function all()
    {
        return $this->section->active()->get();
    }

    public function getAll()
    {
        return $this->section->latest()->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        try {
            $sectionStore              = new $this->section;
            $sectionStore->name        = $request->name;
            $sectionStore->status      = $request->status;
            $sectionStore->save();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function show($id)
    {
        return $this->section->find($id);
    }

    public function update($request, $id)
    {
        try {
            $sectionUpdate              = $this->section->findOrfail($id);
            $sectionUpdate->name        = $request->name;
            $sectionUpdate->status      = $request->status;
            $sectionUpdate->save();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        try {
            $sectionDestroy = $this->section->find($id);
            $sectionDestroy->delete();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
