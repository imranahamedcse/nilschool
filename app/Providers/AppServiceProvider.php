<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\WebsiteSetup\PageSections;
use App\Models\WebsiteSetup\Subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) {

            try {

                $subscriber = Subscribe::count(); 
                $sections   = PageSections::with('upload')->get();
    
                $sectionArr = [];
                foreach($sections as $section){
                    $sectionArr[$section->key]   = $section;
                }
            
                $view->with([
                    'sections'   => $sectionArr,
                    'subscriber' => $subscriber,
                ]);
            } catch (\Exception $e) {
                $view->with([
                    'sections'   => [],
                    'subscriber' => 0,
                ]);
            }
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('APP_HTTPS')==true){
            URL::forceScheme('https');
        }
        Paginator::useBootstrap();
    }
}
