<?php 
namespace app\providers;


/**
 * @package app\providers\FormProvider 
*/
class FormProvider  extends BaseProvider
{
       /**
        * Register service provider
        * @return void
        */
	   public function register()
	   {
	   	    $this->app->set('form', function () {
                return new Bootstrap();
	   	    });
	   }
}