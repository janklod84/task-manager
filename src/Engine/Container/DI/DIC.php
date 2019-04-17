<?php 
namespace JanKlod\Container\DI;

use JanKlod\Container\ContainerInterface;
use JanKlod\Container\Entitable;
use JanKlod\Container\Entity\Registry;
use JanKlod\Container\Entity\Multiton;
use \ReflectionClass;



/**
 * @package JanKlod\Container\DI\DIC
*/
class DIC  implements ContainerInterface
{

       /**
        * container
        * @var array
       */
       private $container = [];

   
       /**
        * Constructor
        * @param array $container
        * @return void
       */
       public function __construct($container = []) 
       {
             $this->container = array_merge($this->container, $container);
       }
      

       
       /**
        * Add item in container
        * @param string $key 
        * @param type $resolver 
        * @return type
       */
       public function set(string $key, $resolver)
       {
             $this->container[$key] = $resolver;
       }


       /**
  	    * Add item in registry
  	    * @param string $key 
  	    * @param mixed $value 
  	    * @return void
  	   */
       public function registry(string $key, $resolver)
       {
             $this->set($key, new Registry($key, $resolver));
       }

       
       /**
        * Add singleton in singletons container
        * @param string $key 
        * @param mixed $resolver 
        * @return void
       */
       public function singleton(string $key, $resolver)
       {
            $this->set($key, new Multiton($key, $resolver));
       }

         
       /**
        * Get item by key from container
        * @param mixed $key 
        * @return mixed
       */
       public function get(string $key)
       {
             if(isset($this->container[$key]))
             {
             	   if($this->container[$key] instanceof Entitable)
             	   {
             	   	   return $this->container[$key]->get($key);

             	   }

             	   return $this->call($this->container[$key]);
             }
       }



       /**
        * Print Out all datas inside container
        * @return void
       */
       public function getContainer()
       {    
       	    return $this->container;
       }


        /**
         * Call shared item directy by key name
         * Exemple : $this->{$key} if isset this key [$this->app->{$key}]
         * 
         * @param string $key 
         * @return mixed
        */
        public function __get($key)
        {
             return $this->get($key);
        }

       
       /**
         * Call container
         * @param type $container 
         * @return type
       */
       private function call($container)
       {
            if($container instanceof \Closure)
            {
                return $container($this);
            }
          
            return $container;
       }

       
       /**
         * Create new object
         * @param type $name 
         * @return type
        */
        public function create(string $name)
        {
            return $this->createNewObject($name);
        }


        /**
         * Merge data in container
         * @param array $data 
         * @return void
        */
        public function merge(array $data = [])
        {
            $this->container = array_merge($this->container, $data);
        }




       /**
         * Create new object if class exist
         * This method will be extended !
         * 
         * @param string $objName 
		     * @param $params constructor params
         * @return object
        */
        private function createNewObject($objName): object
        {
             if(!class_exists($objName))
             {
                exit(sprintf('Sorry class <strong>%s</strong> does\'nt exist', $objName));
             }

             $reflectedClass = new ReflectionClass($objName);
             $instance = $reflectedClass->getName();
             $this->container[$objName] = new $instance; 
             return $this->container[$objName];
        }

}