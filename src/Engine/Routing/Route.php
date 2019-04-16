<?php 
namespace JanKlod\Routing;


/**
 * Class Route Register
 * @package JanKlod\Routing\Route
*/ 
class Route
{


	      /**
          * Add Routes by method GET
          * 
          * @param string $path 
          * @param mixed $callback
          * @param string $name 
          * @return RouteInterface
         */
         public static function get(
         	string $path, 
         	$callback, 
         	string $name = null
         ): RouteInterface
         {
                return self::add($path, $callback, $name, $method = 'GET');
         }


         /**
           * Add Routes by method POST
           * 
           * @param string $path 
           * @param mixed $callback [string|callable|array] 
           * @param string $name 
           * @return RouteInterface
        */
         public static function post(
         	string $path, 
         	$callback, 
         	string $name = null
         ): RouteInterface
         {
              return self::add($path, $callback, $name, $method = 'POST');
         }


         /**
          * Add new package or resources of routes
          * It's used for CRUD for example
          * 
          * @param string $path
          * @param string $controller
          * @return self
         */
         public static function package(string $path, string $controller)
         {
               self::get("$path", "$controller@index");
               self::post("$path/add", "$controller@add");
               self::post("$path/submit", "$controller@submit");
               self::post("$path/edit/:id", "$controller@edit");
               self::post("$path/save/:id", "$controller@save");
               self::post("$path/delete/:id", "$controller@delete");
         }



         /**
          * Add routes group
          * 
          * @param array $options
          * @param Closure $callback
          * @return void
         */
         public static function group(array $options, \Closure $callback)
         {  
             RouteHandler::setOptions($options);
             return call_user_func($callback, []);
         }

         
         /**
           * Add Routes by AJAX Request
           * 
           * @param string $path 
           * @param mixed $callback [string|callable|array] 
           * @param string $name 
           * @return RouteInterface
        */
         public static function ajax(
          string $path, 
          $callback, 
          string $name = null
         ): RouteInterface
         {
              return self::add($path, $callback, $name, $method = 'AJAX');
         }


         /**
          * Add route with optional params
          * @param string $path 
          * @param array $options 
          * @return void
         */
         public static function map($path, $options = []){}
       

         /**
          * Get URL Named route
          * @param string $name 
          * @param array $params 
          * @return string
         */
         public static function url(string $name, array $params = [])
         {
              return RouteHandler::url($name, $params);
         }


         /**
          * Add not found path
          * @param string $path
          * @return void
         */
         public static function notFound(string $path)
         {
               RouteHandler::notFound($path);
         }




         /**
          * Add routes type from request GET
          * @param string $path
          * @param mixed $callback
          * @param string $name
          * @param string $method
          * 
          * @return RouteInterface
         */
         public static function add(
	         $path, 
	         $callback, 
	         $name, 
	         $method = 'GET'
         ): RouteInterface
         {
              $route = new RouteHandler($path, $callback, $name, $method);
              RouteCollection::store($route);
              $route->filter();
              return $route;
         }
}