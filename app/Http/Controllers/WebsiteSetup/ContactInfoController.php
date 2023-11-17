<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\WebsiteSetup\ContactInfoRepository;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\WebsiteSetup\ContactInfo\ContactInfoStoreRequest;
use App\Http\Requests\WebsiteSetup\ContactInfo\ContactInfoUpdateRequest;

class ContactInfoController extends Controller
{
    private $contactInfoRepo;

    function __construct(ContactInfoRepository $contactInfoRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        } 
        $this->contactInfoRepo                  = $contactInfoRepo;
    }

    public function index()
    {
        $data['contact_info'] = $this->contactInfoRepo->getAll();
        $data['title'] = ___('settings.Contact information');
        return view('website-setup.contact-info.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('website.Create contact information');
        return view('website-setup.contact-info.create', compact('data'));
    }

    public function store(ContactInfoStoreRequest $request)
    {
        $result = $this->contactInfoRepo->store($request);
        if($result['status']){
            return redirect()->route('contact-info.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['contact_info']      = $this->contactInfoRepo->show($id);
        $data['title']       = ___('website.Edit contact information');
        return view('website-setup.contact-info.edit', compact('data'));
    }

    public function update(ContactInfoUpdateRequest $request, $id)
    {
        $result = $this->contactInfoRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('contact-info.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->contactInfoRepo->destroy($id);
        if($result['status']):
            $success[0] = $result['message'];
            $success[1] = 'success';
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
            return response()->json($success);
        else:
            $success[0] = $result['message'];
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
            return response()->json($success);
        endif;     
    }
}
