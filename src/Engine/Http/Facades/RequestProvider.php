<?php 
namespace JanKlod\Http\Facades;

use JanKlod\Service\ServiceProvider;
use JanKlod\Http\Request;



/**
 * @package RequestProvider
*/
class RequestProvider extends ServiceProvider
{
       
       /**
        * Registering request provider
        * @return type
       */
       public function register()
       {
       	   $this->app->set('request', function () {
               return new Request($this->baseUrl());
           });
       }

       /**
        * Get configuration base URL
        * @return string
       */
       private function baseUrl()
       {
          return $this->app->config
                           ->get('app.base_url');
       }
}
