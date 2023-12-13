<?php

namespace App\Http\Repositories\Settings;

use App\Models\Session;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\Language;
use Illuminate\Support\Str;
use App\Traits\CommonHelperTrait;
use App\Http\Interfaces\Settings\SettingInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SettingStoreRequest;
use App\Http\Requests\GeneralSetting\StorageUpdateRequest;


class SettingRepository implements SettingInterface
{
    use CommonHelperTrait;

    private $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return Setting::all();
    }

    public function getLanguage()
    {
        return Language::all();
    }

    public function getSessions()
    {
        return Session::active()->get();
    }

    public function getCurrencies()
    {
        return Currency::get(['code', 'symbol']);
    }

    // General setting start
    public function updateGeneralSetting($request)
    {
        try {
            // Application name start
            if($request->has('application_name')){
                $setting            = $this->model::where('name', 'application_name')->first();
                if($setting){
                    $setting->value = $request->application_name;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'application_name';
                    $setting->value = $request->application_name;
                }
                $setting->save();
            }
            // Application name end

            //Footer Text start
            if($request->has('footer_text')){
                $setting            = $this->model::where('name', 'footer_text')->first();
                if($setting){
                    $setting->value = $request->footer_text;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'footer_text';
                    $setting->value = $request->footer_text;
                }
                $setting->save();
            }
            //Footer Text end

            //Address start
            if($request->has('address')){
                $setting            = $this->model::where('name', 'address')->first();
                if($setting){
                    $setting->value = $request->address;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'address';
                    $setting->value = $request->address;
                }
                $setting->save();
            }
            //Address end

            //Phone start
            if($request->has('phone')){
                $setting            = $this->model::where('name', 'phone')->first();
                if($setting){
                    $setting->value = $request->phone;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'phone';
                    $setting->value = $request->phone;
                }
                $setting->save();
            }
            //Phone end

            //Email start
            if($request->has('email')){
                $setting            = $this->model::where('name', 'email')->first();
                if($setting){
                    $setting->value = $request->email;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'email';
                    $setting->value = $request->email;
                }
                $setting->save();
            }
            //Email end

            //School about start
            if($request->has('school_about')){
                $setting            = $this->model::where('name', 'school_about')->first();
                if($setting){
                    $setting->value = $request->school_about;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'school_about';
                    $setting->value = $request->school_about;
                }
                $setting->save();
            }
            //School about end

            //Defualt language start
            if($request->has('default_langauge')){
                $setting            = $this->model::where('name', 'default_langauge')->first();
                if($setting){
                    $setting->value = $request->default_langauge;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'default_langauge';
                    $setting->value = $request->default_langauge;
                }
                $setting->save();
            }
            //Defualt language end
            //Defualt session start
            if($request->has('session')){
                $setting            = $this->model::where('name', 'session')->first();
                if($setting){
                    $setting->value = $request->session;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'session';
                    $setting->value = $request->session;
                }
                $setting->save();
            }
            //Defualt session end

            // White logo start
            if ($request->has('light_logo') && $request->file('light_logo')->isValid()) {
                $setting            = $this->model::where('name', 'light_logo')->first();
                $path               = 'backend/uploads/settings';
                if ($setting) {
                    $file_path          = public_path($setting->value);
                    // if(file_exists($file_path)){
                    //     File::delete($file_path);
                    // }
                    $file               = $request->file('light_logo');
                    $extension          = $file->guessExtension();
                    $filename           = Str::random(6). '_' . time() . '.' . $extension;
                    if (setting('file_system') == 's3') {
                        $filePath       = s3Upload($path, $file);
                        $setting->value = $filePath;
                    }else{
                        $file->move($path, $filename);
                        $setting->value = $path .'/'. $filename;
                    }
                    $setting->save();

                }else {
                    $setting        = new $this->model;
                    $setting->name  = 'light_logo';
                    $file           = $request->file('light_logo');
                    $extension      = $file->guessExtension();
                    $filename       = Str::random(6). '_' . time() . '.' . $extension;
                    if (setting('file_system') == 's3') {
                        $filePath       = s3Upload($path, $file);
                        $setting->value = $filePath;
                    }else{
                        $file->move($path, $filename);
                        $setting->value = $path .'/'. $filename;
                    }
                    $setting->save();
                }
            }
            // White logo end


            if ($request->has('dark_logo') && $request->file('dark_logo')->isValid()) {
                $setting            = $this->model::where('name', 'dark_logo')->first();
                $path               = 'backend/uploads/settings';
                if ($setting) {
                    $file_path = public_path($setting->value);
                    // if(file_exists($file_path)){
                    //     File::delete($file_path);
                    // }
                    $file               = $request->file('dark_logo');
                    $extension          = $file->guessExtension();
                    $filename           = Str::random(6). '_' . time() . '.' . $extension;
                    if (setting('file_system') == 's3') {
                        $filePath       = s3Upload($path, $file);
                        $setting->value = $filePath;
                    }else{
                        $file->move($path, $filename);
                        $setting->value = $path .'/'. $filename;
                    }
                    $setting->save();

                }else {

                    $setting        = new $this->model;
                    $setting->name  = 'dark_logo';
                    $file           = $request->file('dark_logo');
                    $extension      = $file->guessExtension();
                    $filename       = Str::random(6). '_' . time() . '.' . $extension;
                    if (setting('file_system') == 's3') {
                        $filePath       = s3Upload($path, $file);
                        $setting->value = $filePath;
                    }else{
                        $file->move($path, $filename);
                        $setting->value = $path .'/'. $filename;
                    }
                    $setting->save();
                }
            }

            if ($request->has('favicon') && $request->file('favicon')->isValid()) {
                $setting                = $this->model::where('name', 'favicon')->first();
                $path = 'backend/uploads/settings';
                if ($setting) {
                    $file_path          = public_path($setting->value);
                    // if(file_exists($file_path)){
                    //     File::delete($file_path);
                    // }
                    $file               = $request->file('favicon');
                    $extension          = $file->guessExtension();
                    $filename           = Str::random(6). '_' . time() . '.' . $extension;
                    if (setting('file_system') == 's3') {
                        $filePath       = s3Upload($path, $file);
                        $setting->value = $filePath;
                    }else{
                        $file->move($path, $filename);
                        $setting->value = $path .'/'. $filename;
                    }
                    $setting->save();

                }else {
                    $setting            = new $this->model;
                    $setting->name      = 'favicon';
                    $file = $request->file('favicon');
                    $extension          = $file->guessExtension();
                    $filename           = Str::random(6). '_' . time() . '.' . $extension;
                    if (setting('file_system') == 's3') {
                        $filePath       = s3Upload($path, $file);
                        $setting->value = $filePath;
                    }else{
                        $file->move($path, $filename);
                        $setting->value = $path .'/'. $filename;
                    }
                    $setting->save();
                }
            }


            // Currency Code start
            if($request->has('currency_code')){
                $setting            = $this->model::where('name', 'currency_code')->first();
                if($setting){
                    $setting->value = $request->currency_code;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'currency_code';
                    $setting->value = $request->currency_code;
                }
                $setting->save();
            }
            // Currency Code end


            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    // General setting en

    public function updateMailSetting($request)
    {
        try {
            // Mail drive start
            if($request->has('mail_drive')){
                $setting            = $this->model::where('name', 'mail_drive')->first();
                if($setting){
                    $setting->value = $request->mail_drive;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'mail_drive';
                    $setting->value = $request->mail_drive;
                }
                $setting->save();
            }
            // Mail drive end

            // Mail Host start
            if($request->has('mail_host')){
                $setting            = $this->model::where('name', 'mail_host')->first();
                if($setting){
                    $setting->value = $request->mail_host;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'mail_host';
                    $setting->value = $request->mail_host;
                }
                $setting->save();
            }
            // Mail Host end

            // Mail Host start
            if($request->has('mail_port')){
                $setting            = $this->model::where('name', 'mail_port')->first();
                if($setting){
                    $setting->value = $request->mail_port;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'mail_port';
                    $setting->value = $request->mail_port;
                }
                $setting->save();
            }
            // Mail Host end

            // Mail Address start
            if($request->has('mail_address')){
                $setting            = $this->model::where('name', 'mail_address')->first();
                if($setting){
                    $setting->value = $request->mail_address;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'mail_address';
                    $setting->value = $request->mail_address;
                }
                $setting->save();
            }
            // Mail Address end

            // Form Name start
            if($request->has('from_name')){
                $setting            = $this->model::where('name', 'from_name')->first();
                if($setting){
                    $setting->value = $request->from_name;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'from_name';
                    $setting->value = $request->from_name;
                }
                $setting->save();
            }
            // Form Name end

            // Mail UserName start
            if($request->has('mail_username')){
                $setting            = $this->model::where('name', 'mail_username')->first();
                if($setting){
                    $setting->value = $request->mail_username;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'mail_username';
                    $setting->value = $request->mail_username;
                }
                $setting->save();
            }
            // Mail UserName end

            // Mail UserName start
            if($request->has('mail_password') && $request->mail_password != ""){
                $setting            = $this->model::where('name', 'mail_password')->first();
                if($setting){
                    $setting->value = Crypt::encrypt($request->mail_password);
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'mail_password';
                    $setting->value = Crypt::encrypt($request->mail_password);
                }
                $setting->save();
            }
            // Mail UserName end

            //Encryption start
            if($request->has('encryption')){
                $setting            = $this->model::where('name', 'encryption')->first();
                if($setting){
                    $setting->value = $request->encryption;
                }else{
                    $setting        = new $this->model;
                    $setting->name  = 'encryption';
                    $setting->value = $request->encryption;
                }
                $setting->save();
            }
            //Encryption end

            // email write in env
            // $this->setEnvironmentValue('MAIL_MAILER',           $request->mail_drive);
            $this->setEnvironmentValue('MAIL_HOST',             $request->mail_host);
            $this->setEnvironmentValue('MAIL_PORT',             $request->mail_port);
            $this->setEnvironmentValue('MAIL_USERNAME',         $request->mail_username);
            // $this->setEnvironmentValue('MAIL_PASSWORD',         Crypt::encrypt($request->mail_password));
            $this->setEnvironmentValue('MAIL_ENCRYPTION',       $request->encryption);
            $this->setEnvironmentValue('MAIL_FROM_ADDRESS',     $request->mail_address);
            $this->setEnvironmentValue('MAIL_FROM_NAME',        $request->from_name);
            // email write in env

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}
