<?php

use Illuminate\Support\Facades\Route;

if (config('alogger.routes', true)) {
    Route::prefix('aloggers')->group(function () {
        Route::view('/', 'alogger::aloggers/index');
    });
}
