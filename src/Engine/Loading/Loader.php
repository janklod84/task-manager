<?php 
namespace JanKlod\Loading;


/**
 * @package JanKlod\Loading\Loader 
*/ 
class Loader 
{
          
          const MODEL_PFX = 'app\\models\\%s';
          const CONTROLLER_PFX = 'app\\controllers\\%s';


          /**
           * Constructor
           * @param ContainerInterface $app 
           * @return void
          */
          public function __construct($app)
          {
          	    $this->app = $app;
          }

          
          /**
           * Load Model
           * @param string $name 
           * @return object
          */
          public function model($name)
          {
               $model = sprintf(self::MODEL_PFX, $name);
               return new $model($this->app->db);
          }
	
}