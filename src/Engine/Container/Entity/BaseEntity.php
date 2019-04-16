<?php 
namespace JanKlod\Container\Entity;


use JanKlod\Container\Entitable;

/**
 * @package JanKlod\Container\Entity\BaseEntity
*/
abstract class BaseEntity  implements Entitable
{
        
        /**
         * Constructor
         * @param mixed $key 
         * @param mixed $value 
         * @return void
         */
        abstract public function __construct($key = null, $value = null);


        /**
         * Determine if output is instance of closure
         * @return type
         */
        protected function checkContainer($container)
        {
             if($container instanceof \Closure)
             {
                   return $container();
             }

             return $container;
        }
}