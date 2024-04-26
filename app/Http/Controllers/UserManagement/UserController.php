<?php

namespace App\Http\Controllers\UserManagement;

use Illuminate\Http\Request;
use App\Http\Interfaces\UserManagement\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\UserManagement\User\StoreRequest;
use App\Http\Requests\UserManagement\User\UpdateRequest;
use App\Http\Interfaces\UserManagement\RoleInterface;

class UserController extends Controller
{

    private $user;
    private $role;

    function __construct(
        UserInterface $user,
        RoleInterface $role,

        )
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->user         = $user;
        $this->role         = $role;
    }

    public function index()
    {
        $data['users'] = $this->user->all();

        $title             = ___('common.user');
        $data['headers']   = [
            "title"        => $title,
            "create-permission"   => 'user_create',
            "create-route" => 'users.create',
        ];
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.User Manage"), "route" => ""],
            ["title" => $title, "route" => ""]
        ];
        return view('backend.admin.user_management.users.index', compact('data'));
    }

    public function create()
    {
        $data['title']         = ___('common.create_user');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.User Manage"), "route" => ""],
            ["title" => ___("common.user"), "route" => "users.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['roles']         = $this->role->allActive();
        return view('backend.admin.user_management.users.create', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $result = $this->user->store( $request);
        if ($result) {
            return redirect()->route('users.index')->with('success', ___('alert.user_created_successfully'));
        }
        return redirect()->route('users.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));
    }

    public function edit($id)
    {
        if($id == 1)
            return redirect()->route('users.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));

        $data['title']         = ___('common.update_user');
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.User Manage"), "route" => ""],
            ["title" => ___("common.user"), "route" => "users.index"],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['user']          = $this->user->show($id);
        $data['roles']         = $this->role->allActive();
        return view('backend.admin.user_management.users.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id)
    {
        if($id == 1)
            return redirect()->route('users.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));

        $result = $this->user->update($request, $id);
        if ($result) {
            return redirect()->route('users.index')->with('success', ___('alert.user_updated_successfully'));
        }
        return redirect()->route('users.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));
    }

    public function delete($id)
    {
        if($id == 1)
            return redirect()->route('users.index')->with('danger',  ___('alert.something_went_wrong_please_try_again'));

        if ($this->user->destroy($id)) :
            $success[0] = ___('alert.deleted_successfully');
            $success[1] = "Success";
            $success[2] = ___('alert.deleted');
            $success[3] = ___('alert.OK');
        else :
            $success[0] = ___('alert.something_went_wrong_please_try_again');
            $success[1] = 'error';
            $success[2] = ___('alert.oops');
        endif;
        return response()->json($success);
    }

}
