<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

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
            Route::get('/news',            'news')->name('frontend.news');
            Route::get('/news-detail/{id}', 'newsDetail')->name('frontend.news-detail');
            Route::get('/events',           'events')->name('frontend.events');
            Route::get('/event-detail/{id}','eventDetail')->name('frontend.events-detail');
            Route::get('/contact',          'contact')->name('frontend.contact');
            Route::get('/online-admission', 'onlineAdmission')->name('frontend.online-admission');
            
            Route::post('/contact',         'storeContact')->name('frontend.contact');
            Route::post('/subscribe',       'storeSubscribe')->name('frontend.subscribe');
            Route::post('/online-admission','storeOnlineAdmission')->name('frontend.online-admission');


        });
    });

});