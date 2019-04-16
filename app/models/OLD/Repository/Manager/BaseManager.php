<?php 
namespace app\models\Manager;

use JanKlod\Database\Model;
use \PDO;


/**
 * @package app\models\BaseManager
**/ 
class BaseManager extends Model
{
      

       /**
         * Constructor
         * @param ContainerInterface $app 
         * @return void
       */
  	   public function __construct($app)
  	   {
  	  	    parent::__construct($app);
  	   }

      
        /**
         * Get entity
         * @return string
        */
    	  protected function getEntity()
    	  {
    	  	  return 'app\\models\\' . parent::getEntity();
    	  }

 
        
        /**
         * Definition fetch mode
         * @return void
        */
        protected function fetchMode()
        {
             if(!empty($this->entity))
             {
                 $this->statement->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
             }
        }
}