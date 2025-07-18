<?php

use App\Http\Controllers\StudentInfo\DisabledStudentController;
use App\Http\Controllers\StudentInfo\OnlineAdmissionController;
use App\Http\Controllers\StudentInfo\StudentCategoryController;
use App\Http\Controllers\StudentInfo\ParentGuardianController;
use App\Http\Controllers\StudentInfo\PromoteStudentController;
use App\Http\Controllers\StudentInfo\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['XssSanitizer']], function () {
    Route::group(['middleware' => 'lang'], function () {
        Route::group(['middleware' => ['auth.routes', 'AdminPanel'], 'prefix'=>'students'], function () {

            Route::controller(StudentController::class)->prefix('list')->group(function () {
                Route::get('/',                 'index')->name('student.index')->middleware('PermissionCheck:student_read');
                Route::any('/search',           'search')->name('student.search')->middleware('PermissionCheck:student_read');
                Route::get('/create',           'create')->name('student.create')->middleware('PermissionCheck:student_create');
                Route::post('/store',           'store')->name('student.store')->middleware('PermissionCheck:student_create', 'DemoCheck');
                Route::get('edit/{id}',         'edit')->name('student.edit')->middleware('PermissionCheck:student_update');
                Route::get('show/{id}',         'show')->name('student.show')->middleware('PermissionCheck:student_read');
                Route::PUT('update',            'update')->name('student.update')->middleware('PermissionCheck:student_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('student.delete')->middleware('PermissionCheck:student_delete', 'DemoCheck');

                Route::get('/add-new-document', 'addNewDocument');
                Route::get('/get-students',     'getStudents');
                Route::get('/get-class-section-students', 'getClassSectionStudents');
            });

            Route::controller(StudentCategoryController::class)->prefix('category')->group(function () {
                Route::get('/',                 'index')->name('student-category.index')->middleware('PermissionCheck:student_category_read');
                Route::get('/create',           'create')->name('student-category.create')->middleware('PermissionCheck:student_category_create');
                Route::post('/store',           'store')->name('student-category.store')->middleware('PermissionCheck:student_category_create', 'DemoCheck');
                Route::get('edit/{id}',         'edit')->name('student-category.edit')->middleware('PermissionCheck:student_category_update');
                Route::PUT('update/{id}',       'update')->name('student-category.update')->middleware('PermissionCheck:student_category_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('student-category.delete')->middleware('PermissionCheck:student_category_delete', 'DemoCheck');
            });

            Route::controller(PromoteStudentController::class)->prefix('promote')->group(function () {
                Route::get('/',                 'index')->name('promote-students.index')->middleware('PermissionCheck:promote_students_read');
                Route::post('/search',          'search')->name('promote-students.search')->middleware('PermissionCheck:promote_students_read');
                Route::post('/store',           'store')->name('promote-students.store')->middleware('PermissionCheck:promote_students_create', 'DemoCheck');
                Route::get('/get-class',        'getClass');
                Route::get('/get-sections',     'getSections');
            });

            Route::controller(DisabledStudentController::class)->prefix('disabled')->group(function () {
                Route::get('/',                 'index')->name('disabled-students.index')->middleware('PermissionCheck:disabled_students_read');
                Route::post('/search',          'search')->name('disabled-students.search')->middleware('PermissionCheck:disabled_students_read');
                Route::post('/store',           'store')->name('disabled-students.store')->middleware('PermissionCheck:disabled_students_create', 'DemoCheck');
            });

            Route::controller(ParentGuardianController::class)->prefix('parent')->group(function () {
                Route::get('/',                 'index')->name('parent.index')->middleware('PermissionCheck:parent_read');
                Route::any('/search',           'search')->name('parent.search')->middleware('PermissionCheck:parent_read');
                // Route::get('/create',           'create')->name('parent.create')->middleware('PermissionCheck:parent_create');
                Route::post('/store',           'store')->name('parent.store')->middleware('PermissionCheck:parent_create', 'DemoCheck');
                Route::get('edit/{id}',         'edit')->name('parent.edit')->middleware('PermissionCheck:parent_update');
                Route::PUT('update/{id}',       'update')->name('parent.update')->middleware('PermissionCheck:parent_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('parent.delete')->middleware('PermissionCheck:parent_delete', 'DemoCheck');
                Route::get('add-student/{id}',  'addStudent')->name('parent.add-student');
                Route::get('/get-parent',       'getParent');
                Route::post('/student-store',   'studentStore')->name('parent.student-store');
            });

            Route::controller(OnlineAdmissionController::class)->prefix('online-admissions')->group(function () {
                Route::get('/',                 'index')->name('online-admissions.index')->middleware('PermissionCheck:admission_read');
                Route::any('/search',           'search')->name('online-admissions.search')->middleware('PermissionCheck:admission_read');
                Route::get('edit/{id}',         'edit')->name('online-admissions.edit')->middleware('PermissionCheck:admission_update');
                Route::post('/store',           'store')->name('online-admissions.store')->middleware('PermissionCheck:admission_update', 'DemoCheck');
                Route::delete('/delete/{id}',   'delete')->name('online-admissions.delete')->middleware('PermissionCheck:admission_delete', 'DemoCheck');
            });

        });
    });
});
