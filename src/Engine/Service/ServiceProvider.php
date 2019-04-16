<?php 
namespace JanKlod\Service;


use Janklod\Container\ContainerInterface;

/**
 * @package ServiceProvider
**/
abstract class ServiceProvider
{

  
       /**
        * @var \Janlod\Container\ContainerInterface
       */
       protected $app;


       /**
        * Constructor
        * @param  \Janklod\Container\ContainerInterface $app
        * @return void
       */
       public function __construct(ContainerInterface $app)
       {
             $this->app = $app;
       }


       /**
        * Register service provider
        * @return mixed
       */
       abstract function register();
}