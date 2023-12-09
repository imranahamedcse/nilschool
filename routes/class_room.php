<?php

use App\Http\Controllers\ClassRoom\AssignmentController;
use App\Http\Controllers\ClassRoom\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassRoom\HomeworkController;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix'=>'class-room'], function () {

            Route::controller(HomeworkController::class)->prefix('homework')->name('homework.')->group(function () {
                Route::get('/',                 'index')->name('index')->middleware('PermissionCheck:homework_read');
                Route::any('/search',           'search')->name('search')->middleware('PermissionCheck:homework_read');
                Route::get('/create',           'create')->name('create')->middleware('PermissionCheck:homework_create');
                Route::post('/store',           'store')->name('store')->middleware('PermissionCheck:homework_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('edit')->middleware('PermissionCheck:homework_update');
                Route::put('/update/{id}',      'update')->name('update')->middleware('PermissionCheck:homework_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('delete')->middleware('PermissionCheck:homework_delete', 'DemoCheck');
            });

            Route::controller(AssignmentController::class)->prefix('assignment')->name('assignment.')->group(function () {
                Route::get('/',                 'index')->name('index')->middleware('PermissionCheck:assignment_read');
                Route::any('/search',           'search')->name('search')->middleware('PermissionCheck:assignment_read');
                Route::get('/create',           'create')->name('create')->middleware('PermissionCheck:assignment_create');
                Route::post('/store',           'store')->name('store')->middleware('PermissionCheck:assignment_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('edit')->middleware('PermissionCheck:assignment_update');
                Route::put('/update/{id}',      'update')->name('update')->middleware('PermissionCheck:assignment_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('delete')->middleware('PermissionCheck:assignment_delete', 'DemoCheck');
            });

            Route::controller(PostController::class)->prefix('post')->name('post.')->group(function () {
                Route::get('/',                 'index')->name('index')->middleware('PermissionCheck:post_read');
                Route::any('/search',           'search')->name('search')->middleware('PermissionCheck:post_read');
                Route::get('/create',           'create')->name('create')->middleware('PermissionCheck:post_create');
                Route::post('/store',           'store')->name('store')->middleware('PermissionCheck:post_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('edit')->middleware('PermissionCheck:post_update');
                Route::put('/update/{id}',      'update')->name('update')->middleware('PermissionCheck:post_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('delete')->middleware('PermissionCheck:post_delete', 'DemoCheck');
                Route::get('/view/{id}',        'view')->name('view');
            });

        });
    });
});
