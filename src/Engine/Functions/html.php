<?php 



if(!function_exists('attr'))
{      
	   /**
	    * Retourne all attributes from input field
	    * Ex: <input ' . attr(['class' => 'form-control', 'id' => 'email']) . '>';
	    * it will show <input class ="form-control" id = "email">
	    * 
	    * @param array $attributes 
	    * @return type
	    */
       function attr(array $attributes = [])
	   {
	   	      $output = '';
	          if(!empty($attributes))
	          {
	          	   foreach($attributes as $name => $value)
	               {
	                    $output .= sprintf(' %s="%s"', $name, $value);
	               }
	               return $output;
	          }
	   }
}