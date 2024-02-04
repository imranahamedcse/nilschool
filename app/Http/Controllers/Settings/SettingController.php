<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Settings\SettingInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Requests\Settings\General\StoreRequest;

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

    public function updateGeneralSetting(StoreRequest $request)
    {
        $result = $this->setting->updateGeneralSetting($request);
        if ($result) {
            return redirect()->back()->with('success', ___('alert.general_settings_updated_successfully'));
        }
        return redirect()->back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
    }
    // General setting end

    // mail settings start
    public function mailSetting()
    {
        $data['title'] = ___('common.email_settings');
        $data['breadcrumbs'] = [
            ["title" => ___("common.home"), "route" => "dashboard"],
            ["title" => ___("common.Settings"), "route" => ""],
            ["title" => $data['title'], "route" => ""]
        ];

        $data['data']  = $this->setting->getAll();
        return view('backend.admin.settings.mail-settings', compact('data'));
    }

    public function updateMailSetting(StoreRequest $request)
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
        $data['title']      = ___('common.Task Schedules');
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
        $data['title']      = ___('common.Software Update');
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
