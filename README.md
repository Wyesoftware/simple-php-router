# expressPHPRouter

Server-side PHP Router like express.js

# Server-side index

    include ( *path to router.php file* );

    use Wyesoftware\Router; //get Router class

    Router::use('*choose route URL*', *path to your  route*); //multiple row
    
    Router::app('*api path*'); // default "/api" - single row
    
    Router::render(*path to your client-side index*); // react-app for example

# API Side (Routes)

If you want to use route only for display or oneFunction just don't use Routes class.
If you want routing in your api route do this:

    include (*path to routes.php file*);

    use Wyesoftware\Route; //get Route class
    
    Route::do('*choose url path*', function(*vars*){
	    *some function*
    }, *method*);
    
    Route::export('*route path*');

- do *url path* - you can use variables {something} in your path to use it in your function.
- do *method* - you can use any method that you want - GET, POST, PUT, DELETE. GET is default.

# Examples

index.php

    enter code here
