<?php

namespace App\Repositories\WebsiteSetup;

use App\Enums\Settings;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WebsiteSetup\AboutInterface;
use App\Models\WebsiteSetup\About;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;

class AboutRepository implements AboutInterface{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $about;

    public function __construct(About $about)
    {
        $this->about = $about;
    }

    public function all()
    {
        return $this->about->active()->get();
    }

    public function getAll()
    {
        return $this->about->orderBy('serial')->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $row                   = new $this->about;
            $row->name             = $request->name;
            $row->upload_id        = $this->UploadImageCreate($request->image, 'backend/uploads/abouts');
            $row->icon_upload_id   = $this->UploadImageCreate($request->icon, 'backend/uploads/abouts');
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
        return $this->about->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->about->findOrfail($id);
            $row->name             = $request->name;
            $row->upload_id        = $this->UploadImageUpdate($request->image, 'backend/uploads/abouts', $row->upload_id);
            $row->icon_upload_id   = $this->UploadImageUpdate($request->icon, 'backend/uploads/abouts', $row->icon_upload_id);
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
            $row = $this->about->find($id);
            $this->UploadImageDelete($row->upload_id);
            $this->UploadImageDelete($row->icon_upload_id);
            $row->delete();

            DB::commit();
            return $this->responseWithSuccess(___('alert.deleted_successfully'), []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseWithError(___('alert.something_went_wrong_please_try_again'), []);
        }
    }
}
