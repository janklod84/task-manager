<?php 
namespace JanKlod\Validation\Facades;

use JanKlod\Service\ServiceProvider;
use JanKlod\Validation\Validate;


/**
 * @package JanKlod\Validation\Facades\ValidationProvider 
*/ 
class ValidationProvider  extends ServiceProvider
{
       
       public function register()
       {
       	   $this->app->set('validate', function () {
               return new Validate($this->app->db);
           });
       }
}