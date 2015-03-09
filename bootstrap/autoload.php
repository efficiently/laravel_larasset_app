<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

// For dev tests
// $autoloader = require __DIR__.'/../vendor/autoload.php';
// $autoloader->addPsr4('Barryvdh\\StackMiddleware\\', __DIR__.'/../../turbolinks/vendor/barryvdh/laravel-stack-middleware/src');
// $autoloader->addPsr4('Helthe\\Component\\Turbolinks\\', __DIR__.'/../../turbolinks/vendor/helthe/turbolinks');
// $autoloader->add('Efficiently\\Turbolinks\\', __DIR__.'/../../turbolinks/src');
// $autoloader->addPsr4('Illuminate\\Html\\', __DIR__.'/../../jquery-laravel/vendor/illuminate/html');
// require __DIR__."/../../jquery-laravel/vendor/illuminate/html/helpers.php";
// $autoloader->add('Efficiently\\JqueryLaravel\\', __DIR__.'/../../jquery-laravel/src');
// require __DIR__."/../../jquery-laravel/src/Efficiently/JqueryLaravel/helpers.php";
// $autoloader->add('Efficiently\\Larasset\\', __DIR__.'/../../larasset/src');
// require __DIR__."/../../larasset/src/Efficiently/Larasset/helpers.php";

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$compiledPath = __DIR__.'/../storage/framework/compiled.php';

if (file_exists($compiledPath))
{
	require $compiledPath;
}
