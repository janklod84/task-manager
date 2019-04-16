<?php 
namespace JanKlod\Collections;


/**
 * @package JanKlod\Collections\Fillable
*/
interface Fillable
{
	
	
	    /**
  	    * Assign key and value for item
  	    * @param mixed $key 
  	    * @param mixed $value
  	    * @return void
  	   */
       public function set($key, $value);
         


       /**
        * Get item by key from container
        * @param mixed $key 
        * @return mixed
       */
       public function get($key);




       /**
        * Push item in container
        * @param array $data
        * @return void
       */
       public function push($data);
       
     
     
       /**
        * Remove item by from container
        * @param mixed $key 
        * @return void
       */
       public function remove($key);
	   

}