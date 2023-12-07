<?php

use App\Http\Controllers\Report\AttendanceController;
use App\Http\Controllers\Report\AccountController;
use App\Http\Controllers\Report\ClassRoutineController;
use App\Http\Controllers\Report\DueFeesController;
use App\Http\Controllers\Report\ExamRoutineController;
use App\Http\Controllers\Report\FeesCollectionController;
use App\Http\Controllers\Report\MarksheetController;
use App\Http\Controllers\Report\MeritListController;
use App\Http\Controllers\Report\ProgressCardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix'=>'report'], function () {

            Route::controller(MarksheetController::class)->prefix('marksheet')->group(function () {
                Route::get('/', 'index')->name('report-marksheet.index')->middleware('PermissionCheck:report_marksheet_read');
                Route::post('/search', 'search')->name('marksheet.search')->middleware('PermissionCheck:report_marksheet_read');
                Route::get('/get-students', 'getStudents');
                Route::get('/pdf-generate/{id}/{type}/{class}/{section}', 'generatePDF')->name('report-marksheet.pdf-generate');
            });

            Route::controller(MeritListController::class)->prefix('merit-list')->group(function () {
                Route::get('/', 'index')->name('report-merit-list.index')->middleware('PermissionCheck:report_merit_list_read');
                Route::any('/search', 'search')->name('merit-list.search')->middleware('PermissionCheck:report_merit_list_read');
                Route::get('/pdf-generate/{type}/{class}/{section}', 'generatePDF')->name('report-merit-list.pdf-generate');
            });

            Route::controller(ProgressCardController::class)->prefix('progress-card')->group(function () {
                Route::get('/', 'index')->name('report-progress-card.index')->middleware('PermissionCheck:report_progress_card_read');
                Route::post('/search', 'search')->name('report-progress-card.search');
                Route::get('/get-students', 'getStudents');
                Route::get('/pdf-generate/{class}/{section}/{student}', 'generatePDF')->name('report-progress-card.pdf-generate');
            });

            Route::controller(DueFeesController::class)->prefix('due-fees')->group(function () {
                Route::get('/', 'index')->name('report-due-fees.index')->middleware('PermissionCheck:report_due_fees_read');
                Route::any('/search', 'search')->name('due-fees.search')->middleware('PermissionCheck:report_due_fees_read');
                Route::post('/pdf-generate', 'generatePDF')->name('report-due-fees.pdf-generate');
            });

            Route::controller(FeesCollectionController::class)->prefix('fees-collection')->group(function () {
                Route::get('/', 'index')->name('report-fees-collection.index')->middleware('PermissionCheck:report_fees_collection_read');
                Route::any('/search', 'search')->name('fees-collection.search')->middleware('PermissionCheck:report_fees_collection_read');
                Route::get('/pdf-generate/{class}/{section}/{dates}', 'generatePDF')->name('report-fees-collection.pdf-generate');
            });

            Route::controller(AccountController::class)->prefix('account')->group(function () {
                Route::get('/', 'index')->name('report-account.index')->middleware('PermissionCheck:report_transaction_read');
                Route::any('/search', 'search')->name('account.search')->middleware('PermissionCheck:report_transaction_read');
                Route::get('/get-account-types', 'getAccountTypes');
                Route::post('/pdf-generate', 'generatePDF')->name('report-account.pdf-generate');
            });

            Route::controller(AttendanceController::class)->prefix('attendance')->group(function () {
                Route::get('/report', 'report')->name('report-attendance.report')->middleware('PermissionCheck:report_attendance_read');
                Route::any('/report-search', 'reportSearch')->name('report-attendance.report-search')->middleware('PermissionCheck:report_attendance_read');
                Route::post('/pdf-generate', 'generatePDF')->name('report-attendance.pdf-generate');
            });

            Route::controller(ClassRoutineController::class)->prefix('class-routine')->group(function () {
                Route::get('/', 'index')->name('report-class-routine.index')->middleware('PermissionCheck:report_class_routine_read');
                Route::post('/search', 'search')->name('report-class-routine.search')->middleware('PermissionCheck:report_class_routine_read');
                Route::get('/pdf-generate/{class}/{section}', 'generatePDF')->name('report-class-routine.pdf-generate');
            });

            Route::controller(ExamRoutineController::class)->prefix('exam-routine')->group(function () {
                Route::get('/', 'index')->name('report-exam-routine.index')->middleware('PermissionCheck:report_exam_routine_read');
                Route::post('/search', 'search')->name('report-exam-routine.search')->middleware('PermissionCheck:report_exam_routine_read');
                Route::get('/pdf-generate/{class}/{section}/{type}', 'generatePDF')->name('report-exam-routine.pdf-generate');
            });

        });
    });
});
