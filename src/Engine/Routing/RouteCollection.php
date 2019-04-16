<?php 
namespace JanKlod\Routing;



/**
 * @package JanKlod\Routing\RouteCollection
*/
class RouteCollection
{
       

       /**
        * @var array
       */
	     private static $routes = [];
       

       /**
        * store route object
        * @param RouteInterface $route 
        * @return void
       */
  	   public static function store(RouteInterface $route)
  	   {    
  	   	       $method = $route->getMethod();
               self::$routes[$method][] = $route;
  	   }


       /**
         * get all stored routes
         * @return array [ return self::$routes ]
       */
       public static function all()
       {
            return self::$routes ?? [];  
       }


       /**
        * get route collection count
        * @return int
       */
       public static function count()
       {
           return count(self::$routes);
       }

}