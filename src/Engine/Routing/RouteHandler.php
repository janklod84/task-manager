<?php 
namespace JanKlod\Routing;



/**
 * @package JanKlod\Routing\RouteHandler
*/ 
class RouteHandler implements RouteInterface
{
             
        
            /**
              * route path
              * @var string
            */
            private $path;


            /**
              * route callback
              * @var string
            */
            private $callback;


            /**
              * route name
              * @var string
            */
            private $name;


            /**
              * route request method
              * @var string
            */
            private $method;



            /**
              * route prefixes
              * @var string
            */
            private $prefix = '';


            /**
              * matches
              * @var array
            */
            private $matches = [];


            /**
              * @var array
            */
            private $params = [];
            


            /**
             * @var array
            */
            private static $options = [];



            /**
             * contains named routes
             * @var array
            */
            private static $namedRoutes = [];

            
            /**
             * @var string
            */
            private static $notFound;



            /**
             * @const array 
            */
            /*
            const BASE_PATTERNS = [
                ':id'   => '([0-9]+)',
                ':slug' => '([a-z\-0-9]+)',
            ];
            */

       

            /**
               * Constructor
               * @param string $path 
               * @param mixed  $callback  
               * @param string $name 
               * @param string $method 
               * Method [Request Method GET / POST / PUT / DELETE / HEAD ...]
               * 
               * @return void
            */
            public function __construct(
                $path = null, 
                $callback = null, 
                $name = null, 
                $method = 'GET'
            )
            { 
                    $this->add($path, $callback, $method, $name);
            }

            
            /**
             * Add route params
             * @param string $path 
             * @param mixed $callback 
             * @param string $name 
             * @param string $method 
             * @return void
            */
            public function add($path, $callback, $method, $name)
            {
                  $this->setPath($path);
                  $this->setCallback($callback);
                  $this->setMethod($method);
                  $this->setName($name);      
            }


              
            /**
             * set route path
             * @param string $path 
             * @return void
            */
            public function setPath($path)
            {
                 $path = trim($path, '/');

                 if(isset(self::$options['prefix']))
                 {
                     $this->path = trim(self::$options['prefix'], '/') . '/' . $path;

                 }else{

                     $this->path = $path;
                 }
            }

            
            /**
             * get route path
             * @return string
            */
            public function getPath()
            {
                 return $this->path;
            }


            /**
             * set route callback
             * @param string $callback 
             * @return void
            */
            public function setCallback($callback)
            {
                 if(is_string($callback))
                 {
                      if(strpos($callback, '@') !== false)
                      {
                           list($controller, $action) = explode('@', $callback, 2);

                           if(isset(self::$options['controller']))
                           {
                              $controller = self::$options['controller'] . '\\' . $controller;

                           }

                           $this->callback = 
                           [
                               'controller' => $controller,
                               'action'     => $action
                           ];

                      }else{

                          throw new \Exception(
                            sprintf('<strong> %s </strong> is not valid callback!', $callback)
                          );
                      }
                   
                 }else{

                     $this->callback = $callback;
                 }
                   
            }

            
            /**
             * get route [ Callback ]
             * @return mixed
            */
            public function getCallback()
            {
                 return $this->callback;
            }


            /**
             * set route name
             * @param string $name 
             * @return void
            */
            public function setName($name)
            {
                 $this->name = $name;
            }

            
            /**
             * get route handler
             * @return string
            */
            public function getName()
            {
                 return $this->name;
            }



            /**
             * set route method
             * @param string $method 
             * @return void
            */
            public function setMethod($method)
            {
                 $this->method = $method;
            }

            
            /**
             * get route method
             * @return string
            */
            public function getMethod()
            {
                 return $this->method;
            }



            /**
             * set route params
             * @param array $params 
             * @return void
            */
            public function setParams($params)
            {
                 $this->params = $params;
            }

            
            /**
             * get route params
             * @return array
            */
            public function getParams()
            {
                 return $this->params;
            }
            
            
            /**
              * get route matches params
              * @return array
            */
            public function getMatches()
            {
                return $this->matches;
            }



            /**
              * add not found
              * @param type $path 
              * @return type
            */
            public static function notFound($path)
            {
                 self::$notFound = $path;
            }

          
            /**
             * Get not found page
             * @return string
            */
            public static function getNotFound()
            {
                 return self::$notFound;
            }


            /**
             * set route options
             * @param array $options 
             * @return ''
            */
            public static function setOptions($options)
            {
                 self::$options = $options;
            }


            /**
              * Filter route
              * @return void
            */
            public function filter()
            {
                   if(is_string($this->callback) && $this->name === null)
                   {
                        // $this->name = $this->callback;
                        $this->setName($this->callback);
                   }

                   if($this->name)
                   {
                        // self::$namedRoutes[$this->name] = $this;
                        $this->setNamedRoute($this->name, $this);
                   }

            }

            
            /**
             * set named route
             * @param string $name 
             * @param RouteHandler
             * @return void
            */
            public function setNamedRoute($name, $route)
            {
                 self::$namedRoutes[$name] = $route;
            }


            /**
             * get named route
             * @param string $name 
             * @return $this
            */
            public function getNamedRoute($name = null)
            {
                 if(!is_null($name))
                 {
                    return self::$namedRoutes[$name];
                 }
                 return self::$namedRoutes;
            }


            /**
             * Get Url
             * @param type $name 
             * @param type|array $params 
             * @return type
            */
            public static function url($name, $params = [])
            {
                 if(!isset(self::$namedRoutes[$name]))
                 {
                       return \JanKlod\Common\Url::to($name, $params);
                 }

                 return self::$namedRoutes[$name]->getUrl($params);
            }

  
            
            /**
              * 
              * Route::get('/about/:slug-:id', 'HomeController@index', 'welcome.page')
              *        ->with('id', '[0-9]+')
              *        ->with('slug', '[a-z\-0-9]+');
              * 
              * @param string $param 
              * @param string $regex 
              * @return $this
            */
            public function with($param, $regex)
            {
                 $this->params[$param] = str_replace('(', '(?:', $regex); 
                 return $this;
            }


            
            /**
             * Determine if url matched
             * @param string $url
             * @return bool
            */
            public function match($url)
            {
                 $url   = trim($url, '/');
                 $path  = $this->replacePattern();
                 $regex = "#^$path$#i";

                 if(!preg_match($regex, $url, $matches))
                 {
                      return false;
                 }
                
                 array_shift($matches);
                 $this->matches = $matches;
                 return true;
            }


            /**
              * Return match param
              * @param string $match 
              * @return string 
            */
             private function paramMatch($match)
             {
                   if(isset($this->params[$match[1]]))
                   {
                        return '('. $this->params[$match[1]] . ')';
                   }
                   return '([^/]+)';
             }


            /**
              * Replace param in path
              * @param string $replace 
              * @param callable $callback 
              * @return string
             */
             private function replacePattern()
             {
                  return preg_replace_callback(
                                 '#:([\w]+)#', 
                                 [$this, 'paramMatch'], 
                                 $this->path
                        );
             }


            /**
              * Get Url
              * @param array $params 
              * @return string
             */
             private function getUrl($params)
             {
                  $path = $this->getPath();

                  foreach($params as $k => $v)
                  {
                      $path = str_replace(":$k", $v, $path);
                  } 
                  return $path;
             }


        
}
