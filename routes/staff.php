<?php

use App\Http\Controllers\HumanResource\DepartmentController;
use App\Http\Controllers\HumanResource\DesignationController;
use App\Http\Controllers\HumanResource\PayrollController;
use App\Http\Controllers\HumanResource\StaffAttendanceController;
use App\Http\Controllers\HumanResource\StaffController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix'=>'human-resource'], function () {

            Route::controller(StaffController::class)->prefix('staff')->group(function () {
                Route::get('/',                 'index')->name('staff.index')->middleware('PermissionCheck:user_read');
                Route::get('/show/{id}',        'show')->name('staff.show')->middleware('PermissionCheck:user_read');
                Route::get('/create',           'create')->name('staff.create')->middleware('PermissionCheck:user_create');
                Route::post('/store',           'store')->name('staff.store')->middleware('PermissionCheck:user_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('staff.edit')->middleware('PermissionCheck:user_update');
                Route::put('/update/{id}',      'update')->name('staff.update')->middleware('PermissionCheck:user_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('staff.delete')->middleware('PermissionCheck:user_delete', 'DemoCheck');

                Route::get('/change-role',      'changeRole')->name('change.role');
                Route::post('/status',          'status')->name('staff.status');
                Route::delete('/{id}',          'deletes')->name('staff.deletes');
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

            Route::controller(StaffAttendanceController::class)->prefix('staff-attendance')->group(function () {
                Route::get('/',                 'index')->name('staff-attendance.index')->middleware('PermissionCheck:staff_attendance_read');
                Route::post('/store',           'store')->name('staff-attendance.store')->middleware('PermissionCheck:staff_attendance_create', 'DemoCheck');
                Route::any('/search',           'searchStaff')->name('staff-attendance.search')->middleware('PermissionCheck:staff_attendance_read');
                Route::get('/report',           'report')->name('staff-attendance.report')->middleware('PermissionCheck:staff_attendance_read');
                Route::any('/report-search',    'reportSearch')->name('staff-attendance.report-search')->middleware('PermissionCheck:staff_attendance_read');
            });

            Route::controller(PayrollController::class)->prefix('payroll')->group(function () {
                Route::get('/',                 'index')->name('payroll.index')->middleware('PermissionCheck:user_read');
                Route::get('/show/{id}',        'show')->name('payroll.show')->middleware('PermissionCheck:user_read');
                Route::get('/create',           'create')->name('payroll.create')->middleware('PermissionCheck:user_create');
                Route::post('/store',           'store')->name('payroll.store')->middleware('PermissionCheck:user_create', 'DemoCheck');
                Route::get('/edit/{id}',        'edit')->name('payroll.edit')->middleware('PermissionCheck:user_update');
                Route::put('/update/{id}',      'update')->name('payroll.update')->middleware('PermissionCheck:user_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('payroll.delete')->middleware('PermissionCheck:user_delete', 'DemoCheck');

                Route::get('/change-role',      'changeRole')->name('change.role');
                Route::post('/status',          'status')->name('payroll.status');
                Route::delete('/{id}',          'deletes')->name('payroll.deletes');
            });

        });
    });
});
