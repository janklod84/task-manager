<?php 
namespace JanKlod\Database\Facades;

use JanKlod\Service\ServiceProvider;
use JanKlod\Database\DatabaseManager;


/**
 * @package JanKlod\Database\DatabaseProvider 
*/ 
class DatabaseProvider extends ServiceProvider 
{
       
       /**
        * Registring Database in the container
        * @return void
       */
	   public function register()
	   {
	   	    $this->app->singleton('db', function (){
	   	    	return new DatabaseManager($this->config());
	   	    });
	   }

	   private function config()
	   {
           return $this->app->config->get('database');
	   }
}
