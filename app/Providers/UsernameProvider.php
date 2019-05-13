<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UsernameProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->getUsername();
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

    public function getUsername(){
        view()->composer('inc.backend', 'App\Http\Username');
    }
}
