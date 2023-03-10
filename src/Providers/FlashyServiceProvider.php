<?php

namespace Codersamer\Flashy\Providers;

use Codersamer\Flashy\Http\Middlewares\FlashySessionMiddleware;
use Codersamer\Flashy\Components\FlashyComponent;
use Codersamer\Flashy\Services\Flashy;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FlashyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('flashy', function (Application $app) {
            return new Flashy($app);
        });

        $this->mergeConfigFrom(__DIR__ . '/../configs/flashy.php', 'flashy');

        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'flashy');
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('web', new FlashySessionMiddleware);
    }

    public function boot()
    {
        $kernel = app()->make(Kernel::class);
        $kernel->appendMiddlewareToGroup('web', FlashySessionMiddleware::class);
        Blade::component(FlashyComponent::class, 'flashy');
    }
}
