<?php 
namespace app\providers;

use JanKlod\Validation\Validate;


/**
 * @package JanKlod\Validation\ValidationProvider 
*/ 
class ValidationProvider  extends BaseProvider
{
       public function register()
       {
       	   $this->app->set('validate', function () {
               return new Validate($this->app->db);
           });
       }
}