<?php 
namespace JanKlod\Http\Facades;

use JanKlod\Service\ServiceProvider;
use JanKlod\Http\Response;


/**
 * @package JanKlod\Http\Facades\ResponseProvider
*/
class ResponseProvider extends ServiceProvider
{
       
       public function register()
       {
       	   $this->app->set('response', function () {
               return new Response();
           });
       }
}
