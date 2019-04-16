<?php 
namespace app\providers;

use JanKlod\Service\ServiceProvider;


/**
 * @package app\providers\BaseProvider
*/ 
abstract class BaseProvider extends ServiceProvider 
{
	   /**
        * Register service provider
        * @return void
       */
       abstract public function register();
}
