<?php 
namespace JanKlod\Container;


/**
 * ContainerManager return new container of type ContainerInterface
 * @package JanKlod\Container\ContainerManager
*/ 
class ContainerManager
{
      
         /**
          * @var ContainerInterface
         */
         private $container;

         
         /**
          * Constructor
          * Get current container Dependency Injection
          * Example:
          * You can get container all possiblity you want
          * 
          * return (new ContainerManager(DIC::class))
          *         ->build(['bindKey' => bindValue]);
          * 
          * return (new ContainerManager(new DIC([
          *    'bindKey' => bindValue
          * ])))->build();
          * 
          * 
          * @return ContainerInterface
          * @param mixed $container
          * @return void
         */
    	   public function __construct($container)
    	   {
    	   	     $this->container = $container;
    	   }

         
         /**
          * Build current container
          * @param array $params
          * @return ContainerInterface
         */
    	   public function build($params = []): ContainerInterface
    	   {
                if(is_string($this->container))
                {
                    $this->container = new $this->container($params);
                }

                return $this->container;
    	   }
}