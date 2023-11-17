<?php

namespace App\Repositories\WebsiteSetup;

use App\Models\Slider;
use App\Enums\Settings;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WebsiteSetup\SliderInterface;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;

class SliderRepository implements SliderInterface{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function all()
    {
        return $this->slider->active()->get();
    }

    public function getAll()
    {
        return $this->slider->orderBy('serial')->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $row                   = new $this->slider;
            $row->name            = $request->name;
            $row->upload_id        = $this->UploadImageCreate($request->image, 'backend/uploads/sliders');
            $row->description      = $request->description;
            $row->status           = $request->status;
            $row->serial           = $request->serial;
            $row->save();

            DB::commit();
            return $this->responseWithSuccess(___('alert.created_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function show($id)
    {
        return $this->slider->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->slider->findOrfail($id);
            $row->name            = $request->name;
            $row->upload_id        = $this->UploadImageUpdate($request->image, 'backend/uploads/sliders', $row->upload_id);
            $row->description      = $request->description;
            $row->status           = $request->status;
            $row->serial           = $request->serial;
            $row->save();

            DB::commit();
            return $this->responseWithSuccess(___('alert.updated_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $row = $this->slider->find($id);
            $this->UploadImageDelete($row->upload_id);
            $row->delete();

            DB::commit();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
