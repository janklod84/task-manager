<?php 
namespace JanKlod\Collections\Facades;

use JanKlod\Service\ServiceProvider;
use JanKlod\Collections\Collection;


/**
 * @package JanKlod\Collections\Facades\CollectionProvider
*/
class CollectionProvider extends ServiceProvider
{
       
       public function register()
       {
       	   $this->app->set('collection', function () {
               return new Collection();
           });
       }
}