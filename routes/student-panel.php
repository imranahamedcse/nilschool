<?php

use App\Http\Controllers\StudentPanel\AttendanceController;
use App\Http\Controllers\StudentPanel\ClassRoutineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentPanel\DashboardController;
use App\Http\Controllers\StudentPanel\ExamRoutineController;
use App\Http\Controllers\StudentPanel\MarksheetController;
use App\Http\Controllers\StudentPanel\ProfileController;
use App\Http\Controllers\StudentPanel\SubjectListController;
use App\Http\Controllers\StudentPanel\FeesController;
use App\Http\Controllers\StudentPanel\OnlineExamController;
use App\Http\Repositories\StudentPanel\AttendanceRepository;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => 'StudentPanel'], function () {
            Route::group(['middleware' => ['auth.routes'], 'prefix'=>'student-panel'], function () {

                Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
                    Route::get('/', 'index')->name('student-panel-dashboard.index');
                    Route::post('search-student-menu-data', 'searchStudentMenuData')->name('search-student-menu-data');
                });

                Route::controller(ProfileController::class)->group(function () {
                    Route::get('/profile',              'profile')->name('student-panel.profile');
                    Route::get('/profile/edit',         'edit')->name('student-panel.profile.edit');
                    Route::put('/profile/update',       'update')->name('student-panel.profile.update')->middleware('DemoCheck');

                    Route::get('/password/update',      'passwordUpdate')->name('student-panel.password-update');
                    Route::put('/password/update/store', 'passwordUpdateStore')->name('student-panel.password-update-store')->middleware('DemoCheck');
                });
                Route::controller(SubjectListController::class)->prefix('subject-list')->group(function () {
                    Route::get('/', 'index')->name('student-panel-subject-list.index');
                });
                Route::controller(ClassRoutineController::class)->prefix('class-routine')->group(function () {
                    Route::get('/', 'index')->name('student-panel-class-routine.index');
                    Route::get('/pdf-generate', 'generatePDF')->name('student-panel-class-routine.pdf-generate');
                });
                Route::controller(ExamRoutineController::class)->prefix('exam-routine')->group(function () {
                    Route::get('/', 'index')->name('student-panel-exam-routine.index');
                    Route::post('/search', 'search')->name('student-panel-exam-routine.search');
                    Route::get('/pdf-generate/{type}', 'generatePDF')->name('student-panel-exam-routine.pdf-generate');
                });
                Route::controller(OnlineExamController::class)->prefix('online-examination')->group(function () {
                    Route::get('/', 'index')->name('student-panel-online-examination.index');
                    Route::get('/view/{id}', 'view')->name('student-panel-online-examination.view');
                    Route::get('/result-view/{id}', 'resultView')->name('student-panel-online-examination.result-view');
                    Route::post('/answer-submit', 'answerSubmit')->name('student-panel-online-examination.answer-submit');
                });
                Route::controller(MarksheetController::class)->prefix('marksheet')->group(function () {
                    Route::get('/', 'index')->name('student-panel-marksheet.index');
                    Route::post('/search', 'search')->name('student-panel-marksheet.search');
                    Route::get('/pdf-generate/{type}', 'generatePDF')->name('student-panel-marksheet.pdf-generate');
                    Route::get('/result', 'result')->name('student-panel-marksheet.result');
                });
                Route::controller(AttendanceController::class)->prefix('attendance')->group(function () {
                    Route::get('/', 'index')->name('student-panel-attendance.index');
                    Route::any('/search', 'search')->name('student-panel-attendance.search');
                    Route::post('/attendance', 'attendance')->name('student-panel-attendance.attendance');
                });
                Route::controller(FeesController::class)->prefix('fees')->group(function () {
                    Route::get('/', 'index')->name('student-panel-fees.index');
                    Route::get('pay-modal', 'payModal');
                    Route::post('pay-with-stripe', 'payWithStripe')->name('student-panel-fees.pay-with-stripe');
                    Route::get('pay-with-paypal', 'payWithPaypal')->name('student-panel-fees.pay-with-paypal');
                    Route::get('payment-success', 'paymentSuccess')->name('student-panel-fees.payment.success');
                    Route::get('payment-cancel', 'paymentCancel')->name('student-panel-fees.payment.cancel');
                });

            });
        });
    });
});
