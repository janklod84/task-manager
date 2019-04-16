<?php 
namespace JanKlod\Routing;


use JanKlod\Container\ContainerInterface;


/**
 * @package JanKlod\Routing\Dispatcher 
*/ 
class Dispatcher
{
	     
         
  		 /**
  		  * @var string 
  		 */
       private $prefixController = 'app\\controllers\\%s';


	     /**
        * @var string
       */
	     private $controller;


	     /**
         * @var string
       */
	     private $action = 'index';


       /**
        * current route object
        * @var RouteHandler
       */
	     private $route;

         
       /**
        * @var mixed
       */
	     private $callback;


       /**
        * @var array
       */
	     private $matches = [];



	     /**
	      * Constructor
	      * @param RouteInterface $route
	      * @return void
	     */
	     public function __construct(RouteInterface $route)
	     {
                $this->route    = $route;
                $this->callback = $route->getCallback();
                $this->matches  = $route->getMatches();
	     }

         
       /**
        * Call function current route
        * @param ContainerInterface $app
        * @return mixed
       */
	     public function run(ContainerInterface $app)
	     {
                if(is_array($this->callback))
                {
                  	 $this->controller = $this->getController();
                  	 $this->action     = $this->getAction();
                     
                  	 if(class_exists($this->controller))
                  	 {
                  	 	   $controller = new $this->controller($app);

                  	 	   if(method_exists($controller, $this->action))
                  	 	   {
                  	 	   	     $this->callback = [$controller, $this->action];

                  	 	   }else{

                  	 	   	    // exit('Not Found action');
                              notFound();
                  	 	   }

                  	 }else{

                  	 	   // exit('Not found controller');
                         notFound();
                  	 }

                }

                if(is_callable($this->callback))
                {
                	    return call_user_func_array($this->callback, $this->matches);

                }else{
                     
                     // exit('No callable');
                     notFound();
                }
	     	 
	     }

      
       /**
        * \app\controllers\admin\BlogController
        * \app\controllers\TestController
        * 
        * Get full name of controller
        * @return string
       */
	     public function getController()
	     {
	     	  return sprintf($this->prefixController, $this->callback['controller']);
	     }

         
       /**
        * Get full name of action
        * strpos($name , '@') !== false ? $action : $action .'@index';
        * @param string $name 
        * @return string
       */
       public function getAction()
       {
           	 if($this->callback['action'])
           	 {
           	 	  return mb_strtolower($this->callback['action']);
           	 }
           	 return 'index';
       }
	     

}

