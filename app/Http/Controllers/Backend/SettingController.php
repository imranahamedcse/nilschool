<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\SettingInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\SettingStoreRequest;
use App\Http\Requests\Settings\EmailSettingStoreRequest;
use App\Http\Requests\GeneralSetting\StorageUpdateRequest;
use App\Http\Requests\GeneralSetting\GeneralSettingStoreRequest;
use Illuminate\Support\Facades\Artisan;
use PhpParser\Node\Stmt\TryCatch;

class SettingController extends Controller
{
    private $setting;

    function __construct(SettingInterface $settingInterface)
    {

        if (!Schema::hasTable('settings') && !Schema::hasTable('users')  ) {
            abort(400);
        }
        $this->setting = $settingInterface;
    }

    // General setting start
    public function generalSettings()
    {
        $data['title']       = ___('common.General settings');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['data']       = $this->setting->getAll();
        $data['languages']  = $this->setting->getLanguage();
        $data['sessions']   = $this->setting->getSessions();
        $data['currencies'] = $this->setting->getCurrencies();
        return view('backend.admin.settings.general-settings', compact('data'));
    }

    public function updateGeneralSetting(GeneralSettingStoreRequest $request)
    {
        $result = $this->setting->updateGeneralSetting($request);
        if ($result) {
            return redirect()->back()->with('success', ___('alert.general_settings_updated_successfully'));
        }
        return redirect()->back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }
    // General setting end

    // Storage setting start
    public function storagesetting()
    {

        try {
            $data['title'] = ___('common.storage_settings');
            $data['data']  = $this->setting->getAll();
            return view('backend.admin.settings.storage_setting',compact('data'));
        } catch (\Throwable $th) {
            return redirect('/');
        }
    }

    public function storageSettingUpdate(StorageUpdateRequest $request)
    {
        try {
            $result = $this->setting->storageSettingUpdate($request);
            return back()->with('success', ___('alert.storage_settings_updated_successfully'));
        } catch (\Throwable $th) {
            return back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
        }
    }
    // Storage setting start

    // Recaptcha setting start
    public function recaptchaSetting()
    {
        $data['title'] = ___('common.recaptcha_settings');
        $data['data']  = $this->setting->getAll();
        return view('backend.admin.settings.recaptcha-settings', compact('data'));
    }

    public function updateRecaptchaSetting(SettingStoreRequest $request)
    {
        // return $request;
        $result = $this->setting->updateRecaptchaSetting($request);
        // dd($request);
        if ($result) {
            return redirect()->back()->with('success', ___('alert.recaptcha_settings_updated_successfully'));
        }
        return redirect()->back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }
    // Recaptcha setting end

    // mail settings start
    public function mailSetting()
    {
        $data['title'] = ___('settings.email_settings');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        
        $data['data']  = $this->setting->getAll();
        return view('backend.admin.settings.mail-settings', compact('data'));
    }

    public function updateMailSetting(EmailSettingStoreRequest $request)
    {
        $result = $this->setting->updateMailSetting($request);

        if ($result) {
            return redirect()->back()->with('success', ___('alert.email_settings_updated_successfully'));
        }
        return redirect()->back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }
    // mail settings end


    public function changeTheme(Request $request)
    {
        Session::put('user_theme', $request->theme_mode);
        return true;
    }

    public function taskSchedulers()
    {
        $data['title']      = ___('settings.Task Schedules');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];
        
        return view('backend.admin.settings.task-schedulers', compact('data'));
    }
    public function resultGenerate()
    {
        try {
            Artisan::call('exam:result-generate');
            return redirect()->back()->with('success', ___('alert.run_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
        }
    }




    public function softwareUpdate()
    {
        $data['title']      = ___('settings.Software Update');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        return view('backend.admin.settings.software_update', compact('data'));
    }
    public function installUpdate()
    {
        try {
            Artisan::call('migrate');
            return redirect()->back()->with('success', ___('alert.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
        }
    }
}
