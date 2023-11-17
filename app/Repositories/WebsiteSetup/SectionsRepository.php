<?php

namespace App\Repositories\WebsiteSetup;

use App\Models\Slider;
use App\Enums\Settings;
use App\Interfaces\WebsiteSetup\SectionsInterface;
use Illuminate\Support\Facades\DB;
use App\Interfaces\WebsiteSetup\SliderInterface;
use App\Models\WebsiteSetup\PageSections;
use App\Traits\CommonHelperTrait;
use App\Traits\ReturnFormatTrait;

class SectionsRepository implements SectionsInterface{

    use ReturnFormatTrait;
    use CommonHelperTrait;
    private $sections;

    public function __construct(PageSections $sections)
    {
        $this->sections = $sections;
    }

    public function all()
    {
        return $this->sections->get();
    }

    public function getAll()
    {
        return $this->sections->paginate(Settings::PAGINATE);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $row                   = new $this->sections;
            $row->name             = $request->name;
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
        return $this->sections->find($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $row                   = $this->sections->findOrfail($id);
            if($request->name != '')
                $row->name             = $request->name;
            if($request->image != '')
                $row->upload_id        = $this->UploadImageUpdate($request->image, 'backend/uploads/frontend', $row->upload_id);
            if($request->description != '')
                $row->description      = $request->description;
             
            if($row->key == 'social_links'){ // ----------------------------- social_links -----------------------------
                $data =  [];
                foreach ($request->data['name'] as $key => $value) {
                    $data[] =  [
                        'name' => $value,
                        'icon' => $request->data['icon'][$key],
                        'link' => $request->data['link'][$key],
                    ];
                }
                $row->data = $data;
            }
            
            if($row->key == 'statement'){ // ----------------------------- statement -----------------------------
                $data =  [];
                foreach ($request->data['title'] as $key => $value) {
                    $data[] =  [
                        'title'       => $value,
                        'description' => $request->data['description'][$key],
                    ];
                }
                $row->data = $data;
            }
            
            if($row->key == 'study_at'){ // ----------------------------- study_at -----------------------------
                $data =  [];
                foreach ($request->data['title'] as $key => $value) {
                    $data[] =  [
                        'icon'        => array_key_exists('icon', $request->data) ? ( array_key_exists($key,$request->data['icon']) ? $this->UploadImageCreate($request->data['icon'][$key], 'backend/uploads/frontend') : $row->data[$key]['icon'] ) : $row->data[$key]['icon'],
                        'title'       => $value,
                        'description' => $request->data['description'][$key],
                    ];
                }
                $row->data = $data;
            }
            
            if($row->key == 'explore'){ // ----------------------------- explore -----------------------------
                $data =  [];
                foreach ($request->data['title'] as $key => $value) {
                    $data[] =  [
                        'tab'         => $request->data['tab'][$key],
                        'title'       => $value,
                        'description' => $request->data['description'][$key],
                    ];
                }
                $row->data = $data;
            }
            
            if($row->key == 'why_choose_us'){ // ----------------------------- why_choose_us -----------------------------
                $data =  [];
                foreach ($request->data as $key => $value) {
                    $data[] =  $value;
                }
                $row->data = $data;
            }
            
            if($row->key == 'academic_curriculum'){ // ----------------------------- academic_curriculum -----------------------------
                $data =  [];
                foreach ($request->data as $key => $value) {
                    $data[] =  $value;
                }
                $row->data = $data;
            }

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
            $row = $this->sections->find($id);
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
