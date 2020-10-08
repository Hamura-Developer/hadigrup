<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SistemServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
        require_once app_path() . '/Helpers/Sistem.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
