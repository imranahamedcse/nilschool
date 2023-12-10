<?php

use App\Http\Controllers\Transport\TransportSetupController;
use App\Http\Controllers\Transport\PickupPointController;
use App\Http\Controllers\Transport\RouteController;
use App\Http\Controllers\Transport\TransportStudentController;
use App\Http\Controllers\Transport\VehicleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix' => 'transport'], function () {
            Route::controller(RouteController::class)->prefix('route')->group(function () {
                Route::get('/',                 'index')->name('route.index')->middleware('PermissionCheck:route_read');
                Route::get('/create',           'create')->name('route.create')->middleware('PermissionCheck:route_create');
                Route::post('/store',           'store')->name('route.store')->middleware('PermissionCheck:route_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('route.edit')->middleware('PermissionCheck:route_update');
                Route::put('/update/{id}',      'update')->name('route.update')->middleware('PermissionCheck:route_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('route.delete')->middleware('PermissionCheck:route_delete', 'DemoCheck');
            });
            Route::controller(VehicleController::class)->prefix('vehicle')->group(function () {
                Route::get('/',                 'index')->name('vehicle.index')->middleware('PermissionCheck:vehicle_read');
                Route::get('/create',           'create')->name('vehicle.create')->middleware('PermissionCheck:vehicle_create');
                Route::post('/store',           'store')->name('vehicle.store')->middleware('PermissionCheck:vehicle_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('vehicle.edit')->middleware('PermissionCheck:vehicle_update');
                Route::put('/update/{id}',      'update')->name('vehicle.update')->middleware('PermissionCheck:vehicle_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('vehicle.delete')->middleware('PermissionCheck:vehicle_delete', 'DemoCheck');
            });
            Route::controller(PickupPointController::class)->prefix('pickup-point')->group(function () {
                Route::get('/',                 'index')->name('pickup-point.index')->middleware('PermissionCheck:pickup_point_read');
                Route::get('/create',           'create')->name('pickup-point.create')->middleware('PermissionCheck:pickup_point_create');
                Route::post('/store',           'store')->name('pickup-point.store')->middleware('PermissionCheck:pickup_point_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('pickup-point.edit')->middleware('PermissionCheck:pickup_point_update');
                Route::put('/update/{id}',      'update')->name('pickup-point.update')->middleware('PermissionCheck:pickup_point_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('pickup-point.delete')->middleware('PermissionCheck:pickup_point_delete', 'DemoCheck');
            });
            Route::controller(TransportSetupController::class)->prefix('setup')->group(function () {
                Route::get('/',                 'index')->name('transport-setup.index')->middleware('PermissionCheck:transport_setup_read');
                Route::get('/create',           'create')->name('transport-setup.create')->middleware('PermissionCheck:transport_setup_create');
                Route::post('/store',           'store')->name('transport-setup.store')->middleware('PermissionCheck:transport_setup_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('transport-setup.edit')->middleware('PermissionCheck:transport_setup_update');
                Route::put('/update/{id}',      'update')->name('transport-setup.update')->middleware('PermissionCheck:transport_setup_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('transport-setup.delete')->middleware('PermissionCheck:transport_setup_delete', 'DemoCheck');
                Route::get('/get-vehicle-pickup-point', 'getVehiclePickupPoint');
            });
            Route::controller(TransportStudentController::class)->prefix('student')->group(function () {
                Route::get('/',                 'index')->name('transport-student.index')->middleware('PermissionCheck:transport_student_read');
                Route::get('/create',           'create')->name('transport-student.create')->middleware('PermissionCheck:transport_student_create');
                Route::post('/store',           'store')->name('transport-student.store')->middleware('PermissionCheck:transport_student_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('transport-student.edit')->middleware('PermissionCheck:transport_student_update');
                Route::put('/update/{id}',      'update')->name('transport-student.update')->middleware('PermissionCheck:transport_student_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('transport-student.delete')->middleware('PermissionCheck:transport_student_delete', 'DemoCheck');
            });
        });
    });
});
