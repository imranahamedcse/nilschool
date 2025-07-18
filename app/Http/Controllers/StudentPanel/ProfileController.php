<?php

namespace App\Http\Controllers\StudentPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\Staff\UserInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\StudentPanel\Profile\ProfileUpdateRequest;
use App\Http\Requests\StudentPanel\Profile\PasswordUpdateRequest;

class ProfileController extends Controller
{
    private $user;

    function __construct(UserInterface $userInterface)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->user       = $userInterface;
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.student.profile.profile',compact('data'));
    }

    public function edit()
    {
        $data['title']       = "Edit profile";
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];
        $data['user']        = $this->user->show(Auth::user()->id);
        return view('backend.student.profile.edit',compact('data'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $result = $this->user->profileUpdate($request,Auth::user()->id);
        if($result){
            return redirect()->route('student-panel.profile')->with('success', ___('alert.profile_updated_successfully'));
        }
        return redirect()->route('student-panel.profile')->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }


    public function passwordUpdate()
    {
        $data['title'] = 'Password Update';
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];
        return view('backend.student.profile.update_password',compact('data'));
    }

    public function passwordUpdateStore(PasswordUpdateRequest $request)
    {
        if (Hash::check($request->current_password, Auth::user()->password)) {
            $result = $this->user->passwordUpdate($request,Auth::user()->id);
            if($result){
                return redirect()->route('student-panel.password-update')->with('success', ___('alert.password_updated_successfully'));
            }
            return redirect()->route('student-panel.password-update')->with('danger', ___('alert.something_went_wrong_please_try_again'));
        }else {
            return back()->with('danger','Current password is incorrect');
        }
    }
}
