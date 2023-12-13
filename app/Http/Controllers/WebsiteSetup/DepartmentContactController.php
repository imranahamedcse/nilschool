<?php

namespace App\Http\Controllers\WebsiteSetup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\WebsiteSetup\DepartmentContactRepository;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\WebsiteSetup\DepartmentContact\StoreRequest;
use App\Http\Requests\WebsiteSetup\DepartmentContact\UpdateRequest;

class DepartmentContactController extends Controller
{
    private $depContactRepo;

    function __construct(DepartmentContactRepository $depContactRepo)
    {
        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->depContactRepo                  = $depContactRepo;
    }

    public function index()
    {
        $data['dep_contact'] = $this->depContactRepo->getAll();

        $title             = ___('settings.Department Contact');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'dep_contact_create',
            "create-route" => 'department-contact.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.website-setup.department-contact.index', compact('data'));
    }

    public function create()
    {
        $data['title']       = ___('website.Add Department Contact');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Department information"), "route" => "department-contact.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.website-setup.department-contact.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->depContactRepo->store($request);
        if($result['status']){
            return redirect()->route('department-contact.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function edit($id)
    {
        $data['title']       = ___('website.Edit Department Contact');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Website setup"), "route" => ""],
            ["title" => ___("common.Department information"), "route" => "department-contact.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['dep_contact']      = $this->depContactRepo->show($id);
        return view('backend.admin.website-setup.department-contact.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = $this->depContactRepo->update($request, $id);
        if($result['status']){
            return redirect()->route('department-contact.index')->with('success', $result['message']);
        }
        return back()->with('danger', $result['message']);
    }

    public function delete($id)
    {
        $result = $this->depContactRepo->destroy($id);
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
