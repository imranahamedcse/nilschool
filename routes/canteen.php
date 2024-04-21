<?php

use App\Http\Controllers\Canteen\OrderController;
use App\Http\Controllers\Canteen\ProductCategoryController;
use App\Http\Controllers\Canteen\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix' => 'canteen'], function () {

            Route::controller(ProductCategoryController::class)->prefix('product-category')->group(function () {
                Route::get('/',                 'index')->name('product-category.index')->middleware('PermissionCheck:product_category_read');
                Route::get('/create',           'create')->name('product-category.create')->middleware('PermissionCheck:product_category_create');
                Route::post('/store',           'store')->name('product-category.store')->middleware('PermissionCheck:product_category_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('product-category.edit')->middleware('PermissionCheck:product_category_update');
                Route::put('/update/{id}',      'update')->name('product-category.update')->middleware('PermissionCheck:product_category_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('product-category.delete')->middleware('PermissionCheck:product_category_delete', 'DemoCheck');
            });

            Route::controller(ProductController::class)->prefix('product')->group(function () {
                Route::get('/',                 'index')->name('product.index')->middleware('PermissionCheck:product_read');
                Route::get('/create',           'create')->name('product.create')->middleware('PermissionCheck:product_create');
                Route::post('/store',           'store')->name('product.store')->middleware('PermissionCheck:product_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('product.edit')->middleware('PermissionCheck:product_update');
                Route::put('/update/{id}',      'update')->name('product.update')->middleware('PermissionCheck:product_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('product.delete')->middleware('PermissionCheck:product_delete', 'DemoCheck');
            });

            Route::controller(OrderController::class)->prefix('order')->group(function () {
                Route::get('/',                 'index')->name('order.index')->middleware('PermissionCheck:order_read');
                Route::get('/create',           'create')->name('order.create')->middleware('PermissionCheck:order_create');
                Route::post('/store',           'store')->name('order.store')->middleware('PermissionCheck:order_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('order.edit')->middleware('PermissionCheck:order_update');
                Route::put('/update/{id}',      'update')->name('order.update')->middleware('PermissionCheck:order_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('order.delete')->middleware('PermissionCheck:order_delete', 'DemoCheck');
                Route::any('/search',           'search')->name('order.search')->middleware('PermissionCheck:order_read');
                Route::get('/add-new-item',     'addNewItem');
            });

        });
    });
});
