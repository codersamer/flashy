<?php

namespace Codersamer\Flashy\Providers;

use Codersamer\Flashy\Services\Flashy;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class FlashyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('flashy', function(Application $app){
            return new Flashy($app);
        });
    }

    public function boot()
    {

    }
}
