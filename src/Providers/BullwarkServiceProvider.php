<?php

namespace Bullwark\Providers;

use Bullwark\Middlewares\BullwarkAbility;
use Bullwark\Middlewares\BullwarkAuth;
use Bullwark\Services\BullwarkService;
use Illuminate\Support\ServiceProvider;

class BullwarkServiceProvider extends ServiceProvider
{
    public function boot(){
        
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../Config/bullwark.php', 'bullwark'
        );

        $this->app->singleton(BullwarkService::class, function ($app) {
            return new BullwarkService();
        });

        $this->app['router']->aliasMiddleware('bullwark.auth', BullwarkAuth::class);
        $this->app['router']->aliasMiddleware('bullwark.ability', BullwarkAbility::class);


    }
}