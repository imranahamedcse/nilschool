<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\Backend\MyProfileController;
use App\Http\Controllers\Backend\AuthenticationController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Settings\LanguageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

// Auth::routes();

Route::get('/i-am-sure-to-reset-my-database', [ManagerController::class, 'index'])->name('i-am-sure-to-reset-my-database');


Route::get('/i-am-sure-to-reset-my-database', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['XssSanitizer']], function () {

    Route::group(['middleware' => 'lang'], function () {

        Route::get('/migrate-seed', function () {
            Artisan::call('migrate:fresh --seed');
        });

        Route::controller(LanguageController::class)->prefix('languages')->group(function () {
            Route::get('/change',                   'changeLanguage')->name('languages.change');
        });

        //landing page
        Route::get('/landing', function () {
            return view('frontend-landing.school_landing');
        });


        // Non-auth routes
        Route::group(['middleware' => ['not.auth.routes']], function () {
            // controller namespace
            Route::controller(AuthenticationController::class)->group(function () {

                if (Config::get('app.APP_DEMO')) {
                    Route::get('/', function () {
                        return view('welcome');
                    });
                } else {
                    Route::get('/','loginPage')->name('login');
                }

                Route::get('login',                        'loginPage')->name('login');
                // Route::get('login',                        'loginPage')->name('login.page');
                Route::post('login',                       'login')->name('login.auth');
                Route::get('register',                     'registerPage')->name('register');
                Route::post('register',                    'register')->name('register');
                Route::get('verify-email/{email}/{token}', 'verifyEmail')->name('verify-email');

                // reset password
                Route::get('forgot-password',               'forgotPasswordPage')->name('forgot-password');
                Route::post('forgot-password',              'forgotPassword')->name('forgot.password');

                Route::get('reset-password/{email}/{token}', 'resetPasswordPage')->name('reset-password');
                Route::post('reset-password',                'resetPassword')->name('reset.password');
            });
        });


        // auth routes
        Route::group(['middleware' => ['auth.routes']], function () {

            Route::post('logout',         [AuthenticationController::class, 'logout'])->name('logout');

            Route::group(['middleware' => 'AdminPanel'], function () {

                // dashboard routes
                Route::get('dashboard',                    [DashboardController::class, 'index'])->name('dashboard');
                Route::get('fees-collection-monthly',      [DashboardController::class, 'feesCollectionMonthly']);
                Route::get('revenue',                      [DashboardController::class, 'revenueYearly']);
                Route::get('fees-collection-current-month',[DashboardController::class, 'feesCollectionCurrentMonth']);
                Route::get('income-expense-current-month', [DashboardController::class, 'incomeExpenseCurrentMonth']);
                Route::get('today-attendance',             [DashboardController::class, 'todayAttendance']);
                Route::get('events-current-month',         [DashboardController::class, 'eventsCurrentMonth']);

                Route::get('dashboard/school',[DashboardController::class, 'schoolDashboard'])->name('school_dashboard');
                Route::get('dashboard/lms',   [DashboardController::class, 'lmsDashboard'])->name('lms_dashboard');
                Route::get('dashboard/crm',   [DashboardController::class, 'crmDashboard'])->name('crm_dashboard');
                Route::post('searchMenuData', [DashboardController::class, 'searchMenuData'])->name('searchMenuData');



                Route::controller(MyProfileController::class)->prefix('my')->group(function () {
                    Route::get('/profile',              'profile')->name('my.profile');
                    Route::get('/profile/edit',         'edit')->name('my.profile.edit');
                    Route::put('/profile/update',       'update')->name('my.profile.update')->middleware('DemoCheck');

                    Route::get('/password/update',      'passwordUpdate')->name('passwordUpdate');
                    Route::put('/password/update/store', 'passwordUpdateStore')->name('passwordUpdateStore')->middleware('DemoCheck');
                });


            });
        });
    });
});
