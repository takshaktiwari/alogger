#  Introduction

Can be used for log / record user activity via middleware or by custom code. It has a route middleware `Alogger::class` and has view components to view logs lists and details in admin / user panel.

##  Quick Start

Install using given command:

    composer require takshak/alogger
Run migration using php artisan migrate, loggers table will get migrated.
Use `Alogger::class` middleware in your routes in a group or individually.

    use Takshak\Alogger\Http\Middleware\Alogger;
    /* *
    	...
    Route::middleware([Alogger::class])->group(function(){
    	Route::view('/', 'home');
    	/* *
    	...
    });
    
## More Information
All logs will be stored in loggers table. You can set your preference in `alogger.php`. Run the following command to publish configurations.

    php artisan vendor:publish --provider="Takshak\Alogger\AloggerServiceProvider"

### Configuration (alogger.php)
**`log:`**  you can disable or enable the logger by setting this value *true* or *false*

**`record:`** set all the available properties which will be recorded. *status* key will define tha this parameter needs to be recorded or not. *except* key will ignore (not record) the matching values

**`except:`** pass some urls where alogger will not work, *matches*: pass some parts of url, if current url matches any of these values, logs will not be recorded. *urls*: pass the exact url on which alogger will not log any data

**`max_rows:`** maximum number of rows stored in database

**`max_days:`** number of  days. logs after these days will be deleted

### Commands
**`php artisan alogger:prune`** This will prune the logs depend on max_rows and max_days. log more than *max_rows* and older than *max_days* will be deleted. You can set this command in your scheduler will be manage delete the older logs.

**`php artisan alogger:prune`** All logs will be cleared / flushed from database.

### Components
It has two components with compatible with **bootstrap 4** or **5**

**`<x-alogger-loggers  />`** This component can be used to display all the logs on any page. This has some search and filters and view button for a popup to show the details of the log.

**`<x-alogger-logger logger-id=""  />`**  This component will show the detail of a log. You need to pass the logger id for which you want to see the details

### Using alogger manually
You can use `Alogger Service` to record the log manually from your controller or anywhere else.

    use namespace  Takshak\Alogger\Service;
    /* * * /
    $alogger = new Alogger;
    $alogger->log(data: $data, remarks $remarks);
    /* OR */
    (new Alogger)->log(data: $data, remarks $remarks);
    /* * Setting different properties * */
    (new Alogger)->remarks('your remarks goes here')
    	->data($dataArray)
    	->user($userId_or_userModel)
    	->log();

Available methods to be used with Alogger Service
| Methods | Description |
|--|--|
| remarks($remarks,  $data  =  null) | you can set remarks and data here |
| activity($activity,  $data  =  null) | equivalent to remarks functions |
| data($data) | setting the data, if not set with remarks or activity method |
| user($user) | You can set user by passing user id or user model |
| log($user_id  =  null,  $url  =  null,  $data  =  null,  $remarks  =  null) | logs the activity |

- - -
If you want to contribute, have any suggestion or want say something, please write to takshaktiwari@gmail.com
