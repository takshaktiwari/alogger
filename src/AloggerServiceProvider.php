<?php

namespace Takshak\Alogger;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Takshak\Alogger\Models\Logger;

class AloggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/alogger.php' => config_path('alogger.php')
        ]);

        $this->loadViewsFrom(__DIR__ . '/../views', 'alogger');
        $this->loadViewComponentsAs('alogger', [
            View\Components\Loggers::class,
            View\Components\Logger::class,
        ]);

        $this->registerCommands();
    }

    public function registerCommands()
    {
        Artisan::command('alogger:clear', function () {
            Logger::truncate();
            $this->info('All loggers are successfully flushed');
        })->purpose('Delete all loggers based on configuration');

        Artisan::command('alogger:prune {pretend?}', function () {
            $options = [
                '--model' => [Logger::class]
            ];
            if ($this->argument('pretend')) {
                $options['--pretend'] = true;
            }
            $this->call('model:prune', $options);

            if (config('alogger.max_rows')) {
                $loggers = Logger::count();
                if ($loggers > config('alogger.max_rows')) {
                    Logger::limit($loggers - config('alogger.max_rows'), config('alogger.max_rows'))->delete();
                }
            }
            $this->info('All loggers are successfully pruned');
        })->purpose('Clean / Prune loggers based on configuration');
    }

}
