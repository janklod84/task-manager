<?php 
namespace JanKlod\Routing;


use JanKlod\Http\Message\RequestInterface;


/**
 * @package JanKlod\Routing\Router
*/ 
class Router  implements RouterInterface
{


	         /**
	          * @var array
	         */
	         private $routes = [];

             
             
             /**
              * @var string
             */
	         private $url;


             

	         /**
	          * Constructor
	          * @param string $url
	          * @return void
	         */
		     public function __construct($url = null)
		     {
                    $this->url = trim($url, '/');
                    $this->routes = RouteCollection::all();
		     }

	         
	         /**
	          * Dispatching routes
	          * @param RequestInterface $request
	          * @return mixed
	         */
		     public function dispatch(RequestInterface $request)
		     {
		     	   
		     	   if(!is_null($request))
		     	   {
		     	   	     if(!$this->isMatchedRoutes($request->method()))
			     	     {
			     	   	      // exit('That is not matched routes');
			     	     	  notFound();
			     	     }
                   
	                     foreach($this->matchedRoutes($request->method()) as $route)
	                     {
	                   	      if($this->match($route))
	                   	      {
	                               return new Dispatcher($route);
	                   	      }
	                   	      
	                     }
		     	   
		     	         // exit('Not Found Route');
		     	         notFound();
		     	   }
		     }


             
             /**
              * Determine if route match URL
              * @param RouteInterface $route
              * @return bool
             */
		     public function match(RouteInterface $route): bool
		     {
                  return $route->match($this->url);
		     }

             
             /**
              * Add collection routes
              * @param array $routes 
              * @return void
             */
             public function addRoutes(array $routes = [])
             {
                  $this->routes = array_merge($this->routes, $routes);
             }


             /**
              * Get routes
              * @return array
             */
	         public function getRoutes()
	         {
	         	  return $this->routes;
	         }

             
             /**
	          * Add route
	          * @return void
	         */
		     public function addRoute($route)
		     {
	              return $this->route = $route;
		     }


	         /**
	          * Get route
	          * @return type
	         */
		     public function getRoute()
		     {
	              return $this->route ?? null;
		     }


		     /**
	          * Find Matched routes by request Method
	          * This method return collection routes 
              * @return array
             */
	         public function matchedRoutes($method = 'GET')
	         {
	               return $this->routes[$method] ?? [];
	         }


             /**
              * Determine if routes match Method
              * @return bool
             */
	         public function isMatchedRoutes($method): bool
	         {
	         	  return isset($this->routes[$method]);
	         }



	         /**
		       * Remove Query String
		       * @param string $url [Request uri]
		       * @return string
            */
	        protected static function removeQueryString($url) 
	        {
		            if($url)
		            {
		                $params = explode('&', $url, 2);

		                if(false === strpos($params[0], '='))
		                {
		                    return rtrim($params[0], '/');

		                }else{

		                    return '';
		                }
		            }
	        }
}