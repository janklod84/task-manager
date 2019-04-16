<?php 
namespace JanKlod\Routing\Facades;

use JanKlod\Service\ServiceProvider;
use JanKlod\Routing\Router;



/**
 * @package JanKlod\Routing\Facades\RouterProvider
*/
class RouterProvider extends ServiceProvider
{
       
       public function register()
       {
       	   // http://framework.loc/
       	   $this->app->set('router', function () {
               return new Router($this->getUri()); 
           });
       }


       private function getUri()
       {
       	   return $this->app->request->uri();
       }
}
