<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // // Menu
        // view()->composer('pages.components.nav', 'App\Http\Controllers\pagesController@menu');

        // // Single Blog Menu
        // view()->composer('pages.components.sblog-nav', 'App\Http\Controllers\pagesController@menu');
    }
}
