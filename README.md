# Introduction
Can be used for log / record user activity via middleware or by custom code. It has a route middleware `Alogger::class` and has view components to view logs lists and details in admin / user panel.

## Quick Start
Install using given command:

`
composer require takshak/alogger
`
Use `Alogger::class` middleware in your routes in a group or individually.

`
use Takshak\Alogger\Http\Middleware\Alogger;
/*
 *
 ...
Route::middleware([Alogger::class])->group(function(){
    Route::view('/', 'home');
    /*
     *
     ...
});
`
