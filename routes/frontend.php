<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\AdmissionController;
use App\Http\Controllers\Frontend\AcademicController;
use App\Http\Controllers\Frontend\InformationController;

Route::group(['middleware' => ['XssSanitizer']], function () {

    Route::group(['middleware' => 'lang'], function () {

        Route::group(['controller' => FrontendController::class], function () {
            Route::get('/',                 'index')->name('frontend.home');
            Route::get('/get-classes',      'getClasses');
            Route::get('/get-sections',     'getSections');
            Route::get('/get-exam-type',    'getExamType');
            Route::get('/result',           'result')->name('frontend.result');
            Route::post('/result',          'searchResult')->name('frontend.result');
            Route::get('/pdf-download/{id}/{type}/{class}/{section}', 'downloadPDF')->name('frontend.result.pdf-download');

            Route::get('/about',            'about')->name('frontend.about');
            Route::get('/news',             'news')->name('frontend.news');
            Route::get('/news-detail/{id}', 'newsDetail')->name('frontend.news-detail');
            Route::get('/events',           'events')->name('frontend.events');
            Route::get('/event-detail/{id}','eventDetail')->name('frontend.events-detail');
            Route::get('/contact',          'contact')->name('frontend.contact');
            Route::get('/online-admission', 'onlineAdmission')->name('frontend.online-admission');

            Route::post('/contact',         'storeContact')->name('frontend.contact');
            Route::post('/subscribe',       'storeSubscribe')->name('frontend.subscribe');
            Route::post('/online-admission','storeOnlineAdmission')->name('frontend.online-admission');
        });

        Route::controller(AdmissionController::class)->prefix('admission')->name('admission.')->group(function () {
            Route::get('/',                      'index')->name('index');
            Route::get('/why-our-school',        'why')->name('why-our-school');
            Route::get('/how-to-apply',          'howTo')->name('how-to-apply');
            Route::get('/admission-process',     'process')->name('admission-process');
            Route::get('/financial-assistances', 'finance')->name('financial-assistances');
            Route::get('/fees',                  'fees')->name('fees');
            Route::get('/faq',                   'faq')->name('faq');
            Route::get('/cumpus',                'campus')->name('cumpus');
            Route::get('/apply-online',          'applyOnline')->name('apply-online');
            Route::post('/apply-online',         'storeApplyOnline')->name('apply-online');
        });

        Route::controller(AcademicController::class)->prefix('academic')->name('academic.')->group(function () {
            Route::get('/',                  'index')->name('index');
            Route::get('/blog',              'blog')->name('blog');
            Route::get('/teacher',           'teacher')->name('teacher');
            Route::get('/calendar',          'calendar')->name('calendar');
            Route::get('/curriculum',        'curriculum')->name('curriculum');
            Route::get('/facilities',        'facilities')->name('facilities');
            Route::get('/management',        'management')->name('management');
            Route::get('/service-support',   'serviceSupport')->name('service-support');
            Route::get('/syllabus',          'syllabus')->name('syllabus');
            Route::get('/notices',           'notices')->name('notices');
            Route::get('/notice-detail/{id}','noticeDetail')->name('notice-detail');
            Route::get('/gallery',           'gallery')->name('gallery');
        });

        Route::controller(InformationController::class)->prefix('information')->name('information.')->group(function () {
            Route::get('/',                  'index')->name('index');
            Route::get('/career',            'career')->name('career');
            Route::get('/downloadable-forms','downloadableForms')->name('downloadable-forms');
            Route::get('/lesson-plan',       'lessonPlan')->name('lesson-plan');
            Route::get('/payment',           'payment')->name('payment');
            Route::get('/result',            'result')->name('result');
            Route::post('/result',           'searchResult')->name('result.search');
            Route::get('/pdf-download/{id}/{type}/{class}/{section}', 'downloadPDF')->name('result.pdf-download');
        });
    });

});
