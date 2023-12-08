<?php

use App\Http\Controllers\HR\DepartmentController;
use App\Http\Controllers\HR\DesignationController;
use App\Http\Controllers\HR\RoleController;
use App\Http\Controllers\HR\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix'=>'staff'], function () {
            
            Route::controller(RoleController::class)->prefix('roles')->group(function () {
                Route::get('/',                 'index')->name('roles.index')->middleware('PermissionCheck:role_read');
                Route::get('/create',           'create')->name('roles.create')->middleware('PermissionCheck:role_create');
                Route::post('/store',           'store')->name('roles.store')->middleware('PermissionCheck:role_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('roles.edit')->middleware('PermissionCheck:role_update');
                Route::put('/update/{id}',      'update')->name('roles.update')->middleware('PermissionCheck:role_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('roles.delete')->middleware('PermissionCheck:role_delete', 'DemoCheck');
            });

            Route::controller(UserController::class)->prefix('users')->group(function () {
                Route::get('/',                 'index')->name('users.index')->middleware('PermissionCheck:user_read');
                Route::get('/show/{id}',        'show')->name('users.show')->middleware('PermissionCheck:user_read');
                Route::get('/create',           'create')->name('users.create')->middleware('PermissionCheck:user_create');
                Route::post('/store',           'store')->name('users.store')->middleware('PermissionCheck:user_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('users.edit')->middleware('PermissionCheck:user_update');
                Route::put('/update/{id}',      'update')->name('users.update')->middleware('PermissionCheck:user_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('users.delete')->middleware('PermissionCheck:user_delete', 'DemoCheck');

                Route::get('/change-role',      'changeRole')->name('change.role');
                Route::post('/status',          'status')->name('users.status');
                Route::delete('/{id}',          'deletes')->name('users.deletes');
            });

            Route::controller(DepartmentController::class)->prefix('department')->group(function () {
                Route::get('/',                 'index')->name('department.index')->middleware('PermissionCheck:department_read');
                Route::get('/create',           'create')->name('department.create')->middleware('PermissionCheck:department_create');
                Route::post('/store',           'store')->name('department.store')->middleware('PermissionCheck:department_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('department.edit')->middleware('PermissionCheck:department_update');
                Route::put('/update/{id}',      'update')->name('department.update')->middleware('PermissionCheck:department_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('department.delete')->middleware('PermissionCheck:department_delete', 'DemoCheck');
            });
            
            Route::controller(DesignationController::class)->prefix('designation')->group(function () {
                Route::get('/',                 'index')->name('designation.index')->middleware('PermissionCheck:designation_read');
                Route::get('/create',           'create')->name('designation.create')->middleware('PermissionCheck:designation_create');
                Route::post('/store',           'store')->name('designation.store')->middleware('PermissionCheck:designation_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('designation.edit')->middleware('PermissionCheck:designation_update');
                Route::put('/update/{id}',      'update')->name('designation.update')->middleware('PermissionCheck:designation_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('designation.delete')->middleware('PermissionCheck:designation_delete', 'DemoCheck');
            });

        });
    });
});