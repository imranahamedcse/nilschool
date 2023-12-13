<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\WebsiteSetup\ContactInfoRepository;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\WebsiteSetup\ContactInfo\StoreRequest;
use App\Http\Requests\WebsiteSetup\ContactInfo\UpdateRequest;

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

        $title             = ___('settings.Contact information');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'contact_info_create',
            "create-route" => 'contact-info.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.contact-info.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('website.Add contact information');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Contact information"), "route" => "contact-info.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.website-setup.contact-info.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->contactInfoRepo->store($request);
        if($result['status']){
            return redirect()->route('contact-info.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('website.Edit contact information');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Contact information"), "route" => "contact-info.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['contact_info']      = $this->contactInfoRepo->show($id);
        return view('backend.admin.website-setup.contact-info.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
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
