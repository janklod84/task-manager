<?php 
/*
|----------------------------------------------------------------------
|   Application  :  Framework using pattern MVC
|   Name         :  Janklod
|   Author       :  Jean-Claude [Жан-Клод] <jeanyao34@yahoo.com>
|----------------------------------------------------------------------
*/


/*
|-------------------------------------------------------
|    Environnement mode 
|    true: for Development and false: for Production
|-------------------------------------------------------
*/

define('DEV', false); 


/*
|-------------------------------------------------------
|    Require bootstrap of Application
|-------------------------------------------------------
*/

require_once realpath(__DIR__.'/../bootstrap/app.php');


/*
|-------------------------------------------------------
|    Run Application
|-------------------------------------------------------
*/

$app->run();



/*
|-------------------------------------------------------
|    Show Microtimer when you are in development
|    set in config file [app] 'dev' => true
|    and set language required like: lang => ru | fr | en 
|    by default required language is 'en' English
|-------------------------------------------------------
*/

$app->microTimer($app->currentLang());