<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use App\Project;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Project::creating(function ($project) {
        //     if ( ! $project->isValid()) {
        //         return false;
        //     }
        // });
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
