<?php

use App\Http\Controllers\Dormitory\DormitoryController;
use App\Http\Controllers\Dormitory\DormitorySetupController;
use App\Http\Controllers\Dormitory\DormitoryStudentController;
use App\Http\Controllers\Dormitory\RoomController;
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
            Route::controller(RoomController::class)->prefix('room')->group(function () {
                Route::get('/',                 'index')->name('room.index')->middleware('PermissionCheck:room_read');
                Route::get('/create',           'create')->name('room.create')->middleware('PermissionCheck:room_create');
                Route::post('/store',           'store')->name('room.store')->middleware('PermissionCheck:room_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('room.edit')->middleware('PermissionCheck:room_update');
                Route::put('/update/{id}',      'update')->name('room.update')->middleware('PermissionCheck:room_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('room.delete')->middleware('PermissionCheck:room_delete', 'DemoCheck');
            });
            Route::controller(DormitorySetupController::class)->prefix('setup')->group(function () {
                Route::get('/',                 'index')->name('dormitory-setup.index')->middleware('PermissionCheck:dormitory_setup_read');
                Route::get('/create',           'create')->name('dormitory-setup.create')->middleware('PermissionCheck:dormitory_setup_create');
                Route::post('/store',           'store')->name('dormitory-setup.store')->middleware('PermissionCheck:dormitory_setup_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('dormitory-setup.edit')->middleware('PermissionCheck:dormitory_setup_update');
                Route::put('/update/{id}',      'update')->name('dormitory-setup.update')->middleware('PermissionCheck:dormitory_setup_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('dormitory-setup.delete')->middleware('PermissionCheck:dormitory_setup_delete', 'DemoCheck');
            });
            Route::controller(DormitoryStudentController::class)->prefix('student')->group(function () {
                Route::get('/',                 'index')->name('dormitory-student.index')->middleware('PermissionCheck:dormitory_student_read');
                Route::get('/create',           'create')->name('dormitory-student.create')->middleware('PermissionCheck:dormitory_student_create');
                Route::post('/store',           'store')->name('dormitory-student.store')->middleware('PermissionCheck:dormitory_student_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('dormitory-student.edit')->middleware('PermissionCheck:dormitory_student_update');
                Route::put('/update/{id}',      'update')->name('dormitory-student.update')->middleware('PermissionCheck:dormitory_student_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('dormitory-student.delete')->middleware('PermissionCheck:dormitory_student_delete', 'DemoCheck');
            });
        });
    });
});
