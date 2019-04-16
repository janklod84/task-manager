<?php 

/*
 | 'BASE_AUTO' : Base directory, 
 |  or write __DIR__.'/../' and remove /
 |  or write dirname(__DIR__)
*/

define('BASE_AUTO', __DIR__.'/../');
require_once realpath(BASE_AUTO . 'src/Autoloader.php');


/*
 | 'json'      : full path file for autoloading
 | 'base_path' : base directory
*/

\JanKlod\Autoloader::instance([
	'json'  => realpath(BASE_AUTO . 'autoloader.json'),
	'base_path' => BASE_AUTO
]);