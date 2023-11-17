<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/student_info.php'));
            Route::middleware('web')
                ->group(base_path('routes/academic.php'));
            Route::middleware('web')
                ->group(base_path('routes/fees.php'));
            Route::middleware('web')
                ->group(base_path('routes/staff.php'));
            Route::middleware('web')
                ->group(base_path('routes/examination.php'));
            Route::middleware('web')
                ->group(base_path('routes/accounts.php'));
            Route::middleware('web')
                ->group(base_path('routes/report.php'));
            Route::middleware('web')
                ->group(base_path('routes/attendance.php'));
            Route::middleware('web')
                ->group(base_path('routes/website-setup.php'));
            Route::middleware('web')
                ->group(base_path('routes/student-panel.php'));
            Route::middleware('web')
                ->group(base_path('routes/parent-panel.php'));
            Route::middleware('web')
                ->group(base_path('routes/frontend.php'));
            Route::middleware('web')
                ->group(base_path('routes/library.php'));
            Route::middleware('web')
                ->group(base_path('routes/online-examination.php'));
        });
    }
    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
