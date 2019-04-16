<?php 
namespace JanKlod\Template\Facades;

use JanKlod\Service\ServiceProvider;
use JanKlod\Template\View;


/**
 * @package JanKlod\Template\Facades\ViewProvider 
*/ 
class ViewProvider  extends ServiceProvider
{
        
       public function register()
       {
       	   $this->app->set('view', function () {
               return new View($this->app);
           });
       }
}