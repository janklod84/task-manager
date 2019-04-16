<?php 

if(!function_exists('crop'))
{
     
     /**
      *  Crop string
      * @param string $str 
      * @param int $max
      * @return string
      */
     function crop($str = '', $max = 20)
     {
         return sprintf('%s...', substr($str, 0, $max));
     }
}

