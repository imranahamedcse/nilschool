<?php

use App\Http\Controllers\Attendance\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel']], function () {
            Route::controller(AttendanceController::class)->prefix('attendance')->group(function () {
                Route::get('/',                 'index')->name('attendance.index')->middleware('PermissionCheck:attendance_read');
                Route::post('/store',           'store')->name('attendance.store')->middleware('PermissionCheck:attendance_create', 'DemoCheck');
                Route::any('/search',           'searchStudents')->name('attendance.search');
                Route::get('/report',           'report')->name('attendance.report')->middleware('PermissionCheck:attendance_read');
                Route::any('/report-search',    'reportSearch')->name('attendance.report-search')->middleware('PermissionCheck:attendance_read');
            });
        });
    });
});
