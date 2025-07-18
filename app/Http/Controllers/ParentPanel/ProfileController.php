<?php

namespace App\Http\Controllers\ParentPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\Staff\UserInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\ParentPanel\Profile\ProfileUpdateRequest;
use App\Http\Requests\ParentPanel\Profile\PasswordUpdateRequest;
use App\Models\StudentInfo\ParentGuardian;
use App\Models\StudentInfo\Student;

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
        $parent           = ParentGuardian::where('user_id', Auth::user()->id)->first();
        $data['students'] = Student::where('parent_guardian_id', $parent->id)->get();
        return view('backend.parent.profile.profile',compact('data'));
    }

    public function edit()
    {
        $data['title']        = "Profile Edit";
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];
        $parent           = ParentGuardian::where('user_id', Auth::user()->id)->first();
        $data['students'] = Student::where('parent_guardian_id', $parent->id)->get();
        $data['user']     = $this->user->show(Auth::user()->id);
        return view('backend.parent.profile.edit',compact('data'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $result = $this->user->profileUpdate($request,Auth::user()->id);
        if($result){
            return redirect()->route('parent-panel.profile')->with('success', ___('alert.profile_updated_successfully'));
        }
        return redirect()->route('parent-panel.profile')->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }


    public function passwordUpdate()
    {
        $data['title'] = 'Password Update';
        $data['breadcrumbs']  = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => $data['title'], "route" => ""]
        ];
        $parent           = ParentGuardian::where('user_id', Auth::user()->id)->first();
        $data['students'] = Student::where('parent_guardian_id', $parent->id)->get();
        return view('backend.parent.profile.update_password',compact('data'));
    }

    public function passwordUpdateStore(PasswordUpdateRequest $request)
    {
        if (Hash::check($request->current_password, Auth::user()->password)) {
            $result = $this->user->passwordUpdate($request,Auth::user()->id);
            if($result){
                return redirect()->route('parent-panel.password-update')->with('success', ___('alert.password_updated_successfully'));
            }
            return redirect()->route('parent-panel.password-update')->with('danger', ___('alert.something_went_wrong_please_try_again'));
        }else {
            return back()->with('danger','Current password is incorrect');
        }
    }
}
