<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentPanel\AttendanceController;
use App\Http\Controllers\ParentPanel\ClassRoutineController;
use App\Http\Controllers\ParentPanel\DashboardController;
use App\Http\Controllers\ParentPanel\ExamRoutineController;
use App\Http\Controllers\ParentPanel\FeesController;
use App\Http\Controllers\ParentPanel\MarksheetController;
use App\Http\Controllers\ParentPanel\ProfileController;
use App\Http\Controllers\ParentPanel\SubjectListController;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => 'ParentPanel'], function () {
            Route::group(['middleware' => ['auth.routes'], 'prefix'=>'parent-panel'], function () {

                Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
                    Route::get('/', 'index')->name('parent-panel-dashboard.index');
                    Route::post('/search', 'search')->name('parent-panel-student.search');
                    Route::post('search-parent-menu-data', 'searchParentMenuData')->name('search-parent-menu-data');
                });

                Route::controller(ProfileController::class)->group(function () {
                    Route::get('/profile',              'profile')->name('parent-panel.profile');
                    Route::get('/profile/edit',         'edit')->name('parent-panel.profile.edit');
                    Route::put('/profile/update',       'update')->name('parent-panel.profile.update')->middleware('DemoCheck');

                    Route::get('/password/update',      'passwordUpdate')->name('parent-panel.password-update');
                    Route::put('/password/update/store', 'passwordUpdateStore')->name('parent-panel.password-update-store')->middleware('DemoCheck');
                });

                Route::controller(SubjectListController::class)->prefix('subject-list')->group(function () {
                    Route::get('/', 'index')->name('parent-panel-subject-list.index');
                    Route::post('/search', 'search')->name('parent-panel-subject-list.search');
                });
                Route::controller(ClassRoutineController::class)->prefix('class-routine')->group(function () {
                    Route::get('/', 'index')->name('parent-panel-class-routine.index');
                    Route::post('/search', 'search')->name('parent-panel-class-routine.search');
                    Route::get('/pdf-generate/{student}', 'generatePDF')->name('parent-panel-class-routine.pdf-generate');
                });
                Route::controller(ExamRoutineController::class)->prefix('exam-routine')->group(function () {
                    Route::get('/', 'index')->name('parent-panel-exam-routine.index');
                    Route::post('/search', 'search')->name('parent-panel-exam-routine.search');
                    Route::get('/exam-types', 'getExamTypes');
                    Route::get('/pdf-generate/{student}/{type}', 'generatePDF')->name('parent-panel-exam-routine.pdf-generate');
                });
                Route::controller(MarksheetController::class)->prefix('marksheet')->group(function () {
                    Route::get('/', 'index')->name('parent-panel-marksheet.index');
                    Route::post('/search', 'search')->name('parent-panel-marksheet.search');
                    Route::get('/exam-types', 'getExamTypes');
                    Route::get('/pdf-generate/{student}/{type}', 'generatePDF')->name('parent-panel-marksheet.pdf-generate');
                });
                Route::controller(FeesController::class)->prefix('fees')->group(function () {
                    Route::get('/', 'index')->name('parent-panel-fees.index');
                    Route::post('/search', 'search')->name('parent-panel-fees.search');
                    Route::get('pay-modal', 'payModal');
                    Route::post('pay-with-stripe', 'payWithStripe')->name('parent-panel-fees.pay-with-stripe');
                    Route::get('pay-with-paypal', 'payWithPaypal')->name('parent-panel-fees.pay-with-paypal');
                    Route::get('payment-success', 'paymentSuccess')->name('parent-panel-fees.payment.success');
                    Route::get('payment-cancel', 'paymentCancel')->name('parent-panel-fees.payment.cancel');
                });
                Route::controller(AttendanceController::class)->prefix('attendance')->group(function () {
                    Route::get('/', 'index')->name('parent-panel-attendance.index');
                    Route::any('/search', 'search')->name('parent-panel-attendance.search');
                });

            });
        });
    });
});
