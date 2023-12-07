<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\BloodGroupController;
use App\Http\Controllers\Settings\GenderController;
use App\Http\Controllers\Settings\ReligionController;
use App\Http\Controllers\Settings\SessionController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\LanguageController;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix'=>'settings'], function () {

            Route::controller(LanguageController::class)->prefix('languages')->group(function () {
                Route::get('/',                         'index')->name('languages.index')->middleware('PermissionCheck:language_read');
                Route::get('/create',                   'create')->name('languages.create')->middleware('PermissionCheck:language_create');
                Route::post('/store',                   'store')->name('languages.store')->middleware('PermissionCheck:language_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('languages.edit')->middleware('PermissionCheck:language_update');
                Route::put('/update/{id}',              'update')->name('languages.update')->middleware('PermissionCheck:language_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('languages.delete')->middleware('PermissionCheck:language_delete', 'DemoCheck');

                Route::get('/terms/{id}',               'terms')->name('languages.edit.terms')->middleware('PermissionCheck:language_update_terms');
                Route::put('/update/terms/{code}',      'termsUpdate')->name('languages.update.terms')->middleware('PermissionCheck:language_update_terms');
                Route::get('/change-module',            'changeModule')->name('languages.change.module');
            });

            Route::controller(GenderController::class)->prefix('genders')->group(function () {
                Route::get('/',                 'index')->name('genders.index')->middleware('PermissionCheck:gender_read');
                Route::get('/create',           'create')->name('genders.create')->middleware('PermissionCheck:gender_create');
                Route::post('/store',           'store')->name('genders.store')->middleware('PermissionCheck:gender_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('genders.edit')->middleware('PermissionCheck:gender_update');
                Route::put('/update/{id}',      'update')->name('genders.update')->middleware('PermissionCheck:gender_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('genders.delete')->middleware('PermissionCheck:gender_delete', 'DemoCheck');
            });

            Route::controller(ReligionController::class)->prefix('religions')->group(function () {
                Route::get('/',                 'index')->name('religions.index')->middleware('PermissionCheck:religion_read');
                Route::get('/create',           'create')->name('religions.create')->middleware('PermissionCheck:religion_create');
                Route::post('/store',           'store')->name('religions.store')->middleware('PermissionCheck:religion_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('religions.edit')->middleware('PermissionCheck:religion_update');
                Route::put('/update/{id}',      'update')->name('religions.update')->middleware('PermissionCheck:religion_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('religions.delete')->middleware('PermissionCheck:religion_delete', 'DemoCheck');
            });

            Route::controller(BloodGroupController::class)->prefix('blood-groups')->group(function () {
                Route::get('/',                 'index')->name('blood-groups.index')->middleware('PermissionCheck:blood_group_read');
                Route::get('/create',           'create')->name('blood-groups.create')->middleware('PermissionCheck:blood_group_create');
                Route::post('/store',           'store')->name('blood-groups.store')->middleware('PermissionCheck:blood_group_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('blood-groups.edit')->middleware('PermissionCheck:blood_group_update');
                Route::put('/update/{id}',      'update')->name('blood-groups.update')->middleware('PermissionCheck:blood_group_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('blood-groups.delete')->middleware('PermissionCheck:blood_group_delete', 'DemoCheck');
            });

            Route::controller(SessionController::class)->prefix('sessions')->group(function () {
                Route::get('/',                 'index')->name('sessions.index')->middleware('PermissionCheck:session_read');
                Route::get('/create',           'create')->name('sessions.create')->middleware('PermissionCheck:session_create');
                Route::post('/store',           'store')->name('sessions.store')->middleware('PermissionCheck:session_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('sessions.edit')->middleware('PermissionCheck:session_update');
                Route::put('/update/{id}',      'update')->name('sessions.update')->middleware('PermissionCheck:session_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('sessions.delete')->middleware('PermissionCheck:session_delete', 'DemoCheck');
                Route::get('/change',           'changeSession')->name('sessions.change');
            });

            Route::controller(SettingController::class)->prefix('/')->group(function () {
                Route::get('/general',             'generalSettings')->name('settings.general-settings')->middleware('PermissionCheck:general_settings_read');
                Route::post('/general',            'updateGeneralSetting')->name('settings.general-settings')->middleware('PermissionCheck:general_settings_update', 'DemoCheck');
                Route::get('/email',               'mailSetting')->name('settings.mail-setting')->middleware('PermissionCheck:email_settings_read');
                Route::post('/email',              'updateMailSetting')->name('settings.mail-setting')->middleware('PermissionCheck:email_settings_update', 'DemoCheck');
                //Theme Change
                Route::post('/change-theme',       'changeTheme')->name('changeTheme');
                // task schedulers
                Route::get('/task-schedulers',     'taskSchedulers')->name('settings.task-schedulers')->middleware('PermissionCheck:email_settings_update');
                Route::get('/result-generate',     'resultGenerate')->name('settings.result-generate')->middleware('PermissionCheck:email_settings_update', 'DemoCheck');
                // software update
                Route::get('/software-update',     'softwareUpdate')->name('settings.software-update')->middleware('PermissionCheck:software_update_read');
                Route::get('/install-update',      'installUpdate')->name('settings.install-update')->middleware('PermissionCheck:software_update_update', 'DemoCheck');
            });

        });
    });
});
