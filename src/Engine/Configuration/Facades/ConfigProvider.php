<?php 
namespace JanKlod\Configuration\Facades;

use JanKlod\Service\ServiceProvider;
use JanKlod\Configuration\Config;


/**
 * @package JanKlod\configs\Facades\ConfigProvider
*/
class ConfigProvider extends ServiceProvider
{
       
       public function register()
       {
       	   $this->app->singleton('config', function () {
               return new Config($this->app->configs);
           });
       }
}