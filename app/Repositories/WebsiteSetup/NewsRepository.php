<?php

namespace App\Repositories\WebsiteSetup;

use App\Models\News;
use App\Enums\Settings;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WebsiteSetup\NewsInterface;
use App\Traits\ReturnFormatTrait;
use App\Traits\CommonHelperTrait;

class NewsRepository implements NewsInterface{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function all()
    {
        return $this->news->active()->get();
    }

    public function getAll()
    {
        return $this->news->orderBy('id', 'desc')->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $row                   = new $this->news;
            $row->title            = $request->title;
            $row->description      = $request->description;
            $row->date             = $request->date;
            $row->publish_date     = $request->publish_date;
            $row->upload_id        = $this->UploadImageCreate($request->image, 'backend/uploads/news', $row->upload_id);
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
        return $this->news->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->news->findOrfail($id);
            $row->title            = $request->title;
            $row->description      = $request->description;
            $row->date             = $request->date;
            $row->publish_date     = $request->publish_date;
            $row->upload_id        = $this->UploadImageUpdate($request->image, 'backend/uploads/news', $row->upload_id);
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
            $row = $this->news->find($id);
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
