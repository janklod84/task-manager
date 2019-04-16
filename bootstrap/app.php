<?php 



/*
|----------------------------------------------------------------------
|   Autoloading classes and dependencies of application
|----------------------------------------------------------------------
*/
require_once realpath(__DIR__ .'/../vendor/autoload.php');



/*
|----------------------------------------------------------------------
|    Error Handler settings
|----------------------------------------------------------------------
*/

error_reporting(E_ALL);
set_error_handler('JanKlod\Exception\ErrorHandler::errorHandler');
set_exception_handler('JanKlod\Exception\ErrorHandler::exceptionHandler');





/*
|--------------------------------------------------------------------
|     Compare the user php version with that used by Application
|--------------------------------------------------------------------
*/

if(!version_compare($u = PHP_VERSION, $v = \JanKlod\Definition::APP_VERSION['php'], '>='))
{
     exit(sprintf(\JanKlod\Definition::APP_MSG['php_version'], $v, $u));
}


/*
|-------------------------------------------------------------------
|    Route Directory of Application
|    Root directory specifly  dirname(__DIR__) or [../]
|-------------------------------------------------------------------
*/

define('ROOT', '../');

/*
|-------------------------------------------------------------------
|    Get instance of Application 
|-------------------------------------------------------------------
*/

$app = \JanKlod\Foundation\Application::instance(ROOT);

