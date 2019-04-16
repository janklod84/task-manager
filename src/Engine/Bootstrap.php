<?php 
namespace JanKlod;


use JanKlod\Common\Session;


/**
 * This class initialize all services and paths we wants
 * it bootstrap of Application
 * @package JanKlod\Bootstrap
*/ 
class Bootstrap
{
       
       /**
        * @const string
       */
       const PATHS = [
       	  'config'    =>  'app/config/*.php',
          'route'     =>  'routes/*.php'
       ];


       /**
        * container all alias
        * @var array
       */
       private $alias = [];


       /**
        * container all providers
        * @var array
       */
       private $providers = [];


       /**
        * @var ContainerInterface
       */
       private $app;

       
       /**
        * @var FileInterface
       */
       private $file;


       /**
        * Constructor
        * @param ContainerInterface $app 
        * @return void
       */
  	   public function __construct($app)
  	   {
            # Start session
            Session::start();
            $this->app = $app;
            $this->file = $app->file;
  	   }

      
       
       /**
        * Load config of application
        * @return void
       */
  	   public function config()
  	   {
  	   	      $data = [];
              foreach($this->file->map(self::PATHS['config']) as $file)
              {
                    $key = $this->file->details($file)['filename'];
      			        $data[$key] = include($file);
              }
              
              $this->app->set('configs', $data);
              return $this;
  	   }


       
       /**
        * Load alias
        * @return self
       */
    	 public function alias()
    	 {
            $this->alias = $this->getMergeData('alias');
            foreach ($this->alias as $alias => $class_name)
            {
                 if(class_exists($class_name))
                 {
                      class_alias($class_name, $alias);
                 }
            }

            return $this;
    	 }


	      /**
          * 
          * @return void
        */
    	   public function providers()
    	   {
                $this->providers = $this->getMergeData('providers');

                foreach($this->providers as $service)
                {      
                     if(!class_exists($service))
                     {
                         exit(sprintf('class <strong>%s</strong> does not exist!', $service));
                     }

                     $provider = new $service($this->app);
                     call_user_func([$provider, 'register'], []);
                }
    	   }

         
         /**
          * Load routes of application
          * @return void
         */
         public function routes()
         {
             $this->file->calls($this->routePaths());
         }

       
         /**
          * starting all services and includes path
          * @return void
         */
    	   public function run()
    	   {
              $this->config()->alias()->providers();
              $this->routes();
    	   }

       
         /**
          * Get all alias of application
          * @return array
         */
    	   public function getAlias()
    	   {
               return $this->alias ?? [];
    	   }


         /**
          * Get all providers of application
          * @return array
         */
         public function getProviders()
         {
               return $this->providers ?? [];
         }

       
         /**
          * Get merge data from app config and from definitions
          * @param string $key 
          * @return array
         */
    	   private function getMergeData($key)
    	   {
                $config = $this->app->configs['app'][$key] ?? [];
                return array_merge(Definition::APP_SERVICES[$key], $config);
    	   }

         
         /**
          * Return all route paths
          * @return array
         */
         private function routePaths()
         {
             return $this->file->map(self::PATHS['route']);
         }
}