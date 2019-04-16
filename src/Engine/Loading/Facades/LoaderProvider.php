<?php 
namespace JanKlod\Loading\Facades;

use JanKlod\Service\ServiceProvider;
use JanKlod\Loading\Loader;


/**
 * @package JanKlod\Loading\LoaderProvider 
*/ 
class LoaderProvider extends ServiceProvider 
{
       
       /**
        * Registring Loader in the container
        * @return void
       */
	   public function register()
	   {
	   	    $this->app->singleton('load', function (){
	   	    	return new Loader($this->app);
	   	    });
	   }
}
