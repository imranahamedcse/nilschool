<?php

use App\Http\Controllers\Accounts\AccountHeadController;
use App\Http\Controllers\Accounts\ExpenseController;
use App\Http\Controllers\Accounts\IncomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        // auth routes
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix' => 'account'], function () {
            Route::controller(AccountHeadController::class)->prefix('head')->group(function () {
                Route::get('/',                 'index')->name('account-head.index')->middleware('PermissionCheck:account_head_read');
                Route::get('/create',           'create')->name('account-head.create')->middleware('PermissionCheck:account_head_create');
                Route::post('/store',           'store')->name('account-head.store')->middleware('PermissionCheck:account_head_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('account-head.edit')->middleware('PermissionCheck:account_head_update');
                Route::put('/update/{id}',      'update')->name('account-head.update')->middleware('PermissionCheck:account_head_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('account-head.delete')->middleware('PermissionCheck:account_head_delete', 'DemoCheck');
            });

            Route::controller(IncomeController::class)->prefix('income')->group(function () {
                Route::get('/',                 'index')->name('income.index')->middleware('PermissionCheck:income_read');
                Route::get('/create',           'create')->name('income.create')->middleware('PermissionCheck:income_create');
                Route::post('/store',           'store')->name('income.store')->middleware('PermissionCheck:income_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('income.edit')->middleware('PermissionCheck:income_update');
                Route::put('/update/{id}',      'update')->name('income.update')->middleware('PermissionCheck:income_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('income.delete')->middleware('PermissionCheck:income_delete', 'DemoCheck');
            });

            Route::controller(ExpenseController::class)->prefix('expense')->group(function () {
                Route::get('/',                 'index')->name('expense.index')->middleware('PermissionCheck:expense_read');
                Route::get('/create',           'create')->name('expense.create')->middleware('PermissionCheck:expense_create');
                Route::post('/store',           'store')->name('expense.store')->middleware('PermissionCheck:expense_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('expense.edit')->middleware('PermissionCheck:expense_update');
                Route::put('/update/{id}',      'update')->name('expense.update')->middleware('PermissionCheck:expense_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('expense.delete')->middleware('PermissionCheck:expense_delete', 'DemoCheck');
            });
        });
    });
});
