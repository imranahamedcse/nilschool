<?php

use App\Http\Controllers\Transport\RouteController;
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
        });
    });
});