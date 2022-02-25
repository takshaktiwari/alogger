<?php

namespace Takshak\Alogger;
use Illuminate\Support\ServiceProvider;

class AloggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {

    }

}
