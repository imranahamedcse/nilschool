<?php

use App\Http\Controllers\WebsiteSetup\AboutController;
use App\Http\Controllers\WebsiteSetup\ContactInfoController;
use App\Http\Controllers\WebsiteSetup\ContactMessageController;
use App\Http\Controllers\WebsiteSetup\SliderController;
use App\Http\Controllers\WebsiteSetup\NewsController;
use App\Http\Controllers\WebsiteSetup\CounterController;
use App\Http\Controllers\WebsiteSetup\DepartmentContactController;
use App\Http\Controllers\WebsiteSetup\EventController;
use App\Http\Controllers\WebsiteSetup\GalleryCategoryController;
use App\Http\Controllers\WebsiteSetup\GalleryController;
use App\Http\Controllers\WebsiteSetup\SectionsController;
use App\Http\Controllers\WebsiteSetup\SubscribeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes'], 'prefix'=>'website-setup'], function () {

            Route::controller(SectionsController::class)->prefix('page-sections')->group(function () {
                Route::get('/',                         'index')->name('sections.index')->middleware('PermissionCheck:page_sections_read');
                Route::get('/edit/{id}',                'edit')->name('sections.edit')->middleware('PermissionCheck:page_sections_update');
                Route::put('/update/{id}',              'update')->name('sections.update')->middleware('PermissionCheck:page_sections_update', 'DemoCheck');
                Route::get('/add-social-link',          'addSocialLink');
                Route::get('/add-choose-us',            'addChooseUs');
                Route::get('/add-academic-curriculum',  'addAcademicCurriculum');
            });
            
            Route::controller(AboutController::class)->prefix('abouts')->group(function () {
                Route::get('/',                         'index')->name('about.index')->middleware('PermissionCheck:about_read');
                Route::get('/create',                   'create')->name('about.create')->middleware('PermissionCheck:about_create');
                Route::post('/store',                   'store')->name('about.store')->middleware('PermissionCheck:about_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('about.edit')->middleware('PermissionCheck:about_update');
                Route::put('/update/{id}',              'update')->name('about.update')->middleware('PermissionCheck:about_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('about.delete')->middleware('PermissionCheck:about_delete', 'DemoCheck');
            });

            Route::controller(SliderController::class)->prefix('slider')->group(function () {
                Route::get('/',                         'index')->name('slider.index')->middleware('PermissionCheck:slider_read');
                Route::get('/create',                   'create')->name('slider.create')->middleware('PermissionCheck:slider_create');
                Route::post('/store',                   'store')->name('slider.store')->middleware('PermissionCheck:slider_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('slider.edit')->middleware('PermissionCheck:slider_update');
                Route::put('/update/{id}',              'update')->name('slider.update')->middleware('PermissionCheck:slider_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('slider.delete')->middleware('PermissionCheck:slider_delete', 'DemoCheck');
            });
           
            Route::controller(NewsController::class)->prefix('news')->group(function () {
                Route::get('/',                         'index')->name('news.index')->middleware('PermissionCheck:news_read');
                Route::get('/create',                   'create')->name('news.create')->middleware('PermissionCheck:news_create');
                Route::post('/store',                   'store')->name('news.store')->middleware('PermissionCheck:news_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('news.edit')->middleware('PermissionCheck:news_update');
                Route::put('/update/{id}',              'update')->name('news.update')->middleware('PermissionCheck:news_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('news.delete')->middleware('PermissionCheck:news_delete', 'DemoCheck');
            });
           
            Route::controller(EventController::class)->prefix('event')->group(function () {
                Route::get('/',                         'index')->name('event.index')->middleware('PermissionCheck:event_read');
                Route::get('/create',                   'create')->name('event.create')->middleware('PermissionCheck:event_create');
                Route::post('/store',                   'store')->name('event.store')->middleware('PermissionCheck:event_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('event.edit')->middleware('PermissionCheck:event_update');
                Route::put('/update/{id}',              'update')->name('event.update')->middleware('PermissionCheck:event_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('event.delete')->middleware('PermissionCheck:event_delete', 'DemoCheck');
            });

            Route::controller(CounterController::class)->prefix('counter')->group(function () {
                Route::get('/',                         'index')->name('counter.index')->middleware('PermissionCheck:counter_read');
                Route::get('/create',                   'create')->name('counter.create')->middleware('PermissionCheck:counter_create');
                Route::post('/store',                   'store')->name('counter.store')->middleware('PermissionCheck:counter_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('counter.edit')->middleware('PermissionCheck:counter_update');
                Route::put('/update/{id}',              'update')->name('counter.update')->middleware('PermissionCheck:counter_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('counter.delete')->middleware('PermissionCheck:counter_delete', 'DemoCheck');
            });

            Route::controller(ContactInfoController::class)->prefix('contact-info')->group(function () {
                Route::get('/',                         'index')->name('contact-info.index')->middleware('PermissionCheck:contact_info_read');
                Route::get('/create',                   'create')->name('contact-info.create')->middleware('PermissionCheck:contact_info_create');
                Route::post('/store',                   'store')->name('contact-info.store')->middleware('PermissionCheck:contact_info_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('contact-info.edit')->middleware('PermissionCheck:contact_info_update');
                Route::put('/update/{id}',              'update')->name('contact-info.update')->middleware('PermissionCheck:contact_info_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('contact-info.delete')->middleware('PermissionCheck:contact_info_delete', 'DemoCheck');
            });

            Route::controller(DepartmentContactController::class)->prefix('department-contact')->group(function () {
                Route::get('/',                         'index')->name('department-contact.index')->middleware('PermissionCheck:dep_contact_read');
                Route::get('/create',                   'create')->name('department-contact.create')->middleware('PermissionCheck:dep_contact_create');
                Route::post('/store',                   'store')->name('department-contact.store')->middleware('PermissionCheck:dep_contact_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('department-contact.edit')->middleware('PermissionCheck:dep_contact_update');
                Route::put('/update/{id}',              'update')->name('department-contact.update')->middleware('PermissionCheck:dep_contact_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('department-contact.delete')->middleware('PermissionCheck:dep_contact_delete', 'DemoCheck');
            });

            Route::controller(GalleryCategoryController::class)->prefix('gallery-category')->group(function () {
                Route::get('/',                         'index')->name('gallery-category.index')->middleware('PermissionCheck:gallery_category_read');
                Route::get('/create',                   'create')->name('gallery-category.create')->middleware('PermissionCheck:gallery_category_create');
                Route::post('/store',                   'store')->name('gallery-category.store')->middleware('PermissionCheck:gallery_category_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('gallery-category.edit')->middleware('PermissionCheck:gallery_category_update');
                Route::put('/update/{id}',              'update')->name('gallery-category.update')->middleware('PermissionCheck:gallery_category_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('gallery-category.delete')->middleware('PermissionCheck:gallery_category_delete', 'DemoCheck');
            });

            Route::controller(GalleryController::class)->prefix('gallery')->group(function () {
                Route::get('/',                         'index')->name('gallery.index')->middleware('PermissionCheck:gallery_read');
                Route::get('/create',                   'create')->name('gallery.create')->middleware('PermissionCheck:gallery_create');
                Route::post('/store',                   'store')->name('gallery.store')->middleware('PermissionCheck:gallery_create', 'DemoCheck');
                Route::get('/edit/{id}',                'edit')->name('gallery.edit')->middleware('PermissionCheck:gallery_update');
                Route::put('/update/{id}',              'update')->name('gallery.update')->middleware('PermissionCheck:gallery_update', 'DemoCheck');
                Route::delete('/delete/{id}',           'delete')->name('gallery.delete')->middleware('PermissionCheck:gallery_delete', 'DemoCheck');
            });

            Route::controller(SubscribeController::class)->prefix('subscribe')->group(function () {
                Route::get('/',                         'index')->name('subscribe.index')->middleware('PermissionCheck:subscribe_read');
            });

            Route::controller(ContactMessageController::class)->prefix('contact-message')->group(function () {
                Route::get('/',                         'index')->name('contact-message.index')->middleware('PermissionCheck:contact_message_read');
            });

        });
    });
});
