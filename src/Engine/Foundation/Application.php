<?php 
namespace JanKlod\Foundation;


use JanKlod\Container\ContainerManager;
use JanKlod\Container\DI\DIC;
use JanKlod\FileSystem\File;
use JanKlod\Helper\MicroTimer;
use JanKlod\Bootstrap;


/**
 * @package Janklod\FoundationApplication
*/
final class Application
{
         
		 
            /**
             * Instance of Application
             * @var JanKlod\Application
            */
            private static $instance;



            /**
             * Container Dependency Injection
             * @var JanKlod\Container\ContainerInterface
            */
            private $app;

            

            /**
              * prevent instance from being cloned
            */
            private function __clone(){}

   

            /**
             * prevent instance from being unserialized
            */
            private function __wakeup(){}
  


           /**
            * Contructor
            * @param string $root
            * @return void
           */
            private function __construct($root)
            {
                  $this->app = $this->getContainer();
                  $this->loadFunctions(__DIR__.'/../');
                  $this->bind('file', new File($root));
                  (new Bootstrap($this->app))->run();
            }
        
          


          /**
           * Break Point of Application
           * @return mixed
          */
          public function run()
          {   

               $response = $this->get('response');
               $dispatcher = $this->router->dispatch($this->request);
               $output = (string) $dispatcher->run($this->app);
               $response->setBody($output);
               $response->send();

               // debug($this->app->getContainer());
          } 


          
          /**
           * Get current Dependency Injection Container
           * @return ContainerInterface
          */
          public function getContainer()
          {
               return (new ContainerManager(new DIC()))->build();
          }


          /**
           * @param  string $root
           * @return JanKlod\Foundation\Application
          */
          public static function instance(string $root = null): self
          {
               if(is_null(self::$instance))
               {
                   self::$instance = new self($root);
               }

               return self::$instance;
          }


          /**
          * Bind key and value in DIC [Dependency Injection Container]
          * @param string $key 
          * @param type $resolver 
          * @return void
          */
          public function bind(string $key, $resolver)
          {
                $this->app->set($key, $resolver);
          }



         /**
          * Make Object Factory
          * Create new object [ex: (new Application())->make(Blog::class) ]
          * 
          * $obj = $this->app->make('JanKlod\\Test');
          * $obj->show()
          * 
          * @param string $name 
          * @return object
         */
         public function make(string $name): object
         {
              return $this->app->create($name);
         }

         
         /**
          * Set object as singleton
          * @param string $key 
          * @param mixed|callable $resolver 
          * @return void
         */
         public function singleton(string $key, $resolver)
         {
              $this->app->singleton($key, $resolver);
         }

        
         /**
           * get resolver by key 
           * @param string $key 
           * @return mixed
         */
         public function get($key)
         {
              return $this->app->get($key);
         }

         
         /**
          * Get dynamically item from container
          * @param  string $key 
          * @return mixed
         */
         public function __get($key)
         {
               return $this->get($key);
         }

        
         
         /**
          * Return value current language from config
          * @return int
         */
         public function currentLang()
         {
              return $this->config->get('app.language') ?? 'en';
         }


         /**
          * Check MicroTimer for showing
          * @param string $code 
          * @return string
         */
         public function microTimer($code)
         {
             if($this->environ() === true)
             {
                  $start = defined('MICROTIME') ? MICROTIME : $this->configMicro();
                  return (new MicroTimer($start))->show($code);
             }
         }

         /**
          * Return value microtime from config
          * @return int
         */
         private function configMicro()
         {
              return $this->config->get('app.microtime');
         }


         
         /**
          * Get environnement
          * @return bool
         */
         private function environ(): bool
         {
             return defined('DEV') ? DEV : false;
         }

         
         /**
          * Load all required functions
          * @param string $dir 
          * @return void
          */
         private function loadFunctions($dir)
         {
              require_once trim($dir, '/') .'/Function.php';
         }

}