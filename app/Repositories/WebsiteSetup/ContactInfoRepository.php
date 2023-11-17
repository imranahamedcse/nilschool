<?php

namespace App\Repositories\WebsiteSetup;

use App\Enums\Settings;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WebsiteSetup\ContactInfoInterface;
use App\Models\WebsiteSetup\ContactInfo;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;

class ContactInfoRepository implements ContactInfoInterface{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $contactInfo;

    public function __construct(ContactInfo $contactInfo)
    {
        $this->contactInfo = $contactInfo;
    }

    public function all()
    {
        return $this->contactInfo->active()->get();
    }

    public function getAll()
    {
        return $this->contactInfo->orderBy('id', 'desc')->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $row                   = new $this->contactInfo;
            $row->name             = $request->name;
            $row->address          = $request->address;
            $row->upload_id        = $this->UploadImageCreate($request->image, 'backend/uploads/contact_info');
            $row->status           = $request->status;
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
        return $this->contactInfo->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->contactInfo->findOrfail($id);
            $row->name             = $request->name;
            $row->address          = $request->address;
            $row->upload_id        = $this->UploadImageUpdate($request->image, 'backend/uploads/contact_info', $row->upload_id);
            $row->status           = $request->status;
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
            $row = $this->contactInfo->find($id);
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
