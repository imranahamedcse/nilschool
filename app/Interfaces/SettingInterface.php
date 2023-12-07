<?php

namespace App\Interfaces;

use App\Http\Requests\SettingStoreRequest;

interface SettingInterface{

    public function getAll();

    public function getLanguage();

    public function getSessions();

    public function getCurrencies();

    public function updateMailSetting($request);

    public function updateGeneralSetting($request);
}
