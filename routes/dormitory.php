<?php

use App\Http\Controllers\Dormitory\DormitoryController;
use App\Http\Controllers\Dormitory\RoomTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix' => 'dormitory'], function () {
            Route::controller(RoomTypeController::class)->prefix('room-type')->group(function () {
                Route::get('/',                 'index')->name('room-type.index')->middleware('PermissionCheck:room_type_read');
                Route::get('/create',           'create')->name('room-type.create')->middleware('PermissionCheck:room_type_create');
                Route::post('/store',           'store')->name('room-type.store')->middleware('PermissionCheck:room_type_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('room-type.edit')->middleware('PermissionCheck:room_type_update');
                Route::put('/update/{id}',      'update')->name('room-type.update')->middleware('PermissionCheck:room_type_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('room-type.delete')->middleware('PermissionCheck:room_type_delete', 'DemoCheck');
            });
            Route::controller(DormitoryController::class)->prefix('dormitory')->group(function () {
                Route::get('/',                 'index')->name('dormitory.index')->middleware('PermissionCheck:dormitory_read');
                Route::get('/create',           'create')->name('dormitory.create')->middleware('PermissionCheck:dormitory_create');
                Route::post('/store',           'store')->name('dormitory.store')->middleware('PermissionCheck:dormitory_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('dormitory.edit')->middleware('PermissionCheck:dormitory_update');
                Route::put('/update/{id}',      'update')->name('dormitory.update')->middleware('PermissionCheck:dormitory_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('dormitory.delete')->middleware('PermissionCheck:dormitory_delete', 'DemoCheck');
            });
        });
    });
});
