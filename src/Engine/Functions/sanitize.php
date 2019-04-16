<?php 

if(!function_exists('escape'))
{
	 /**
	  * Espace string data [html data]
	  * @param string $string 
	  * @return string
	 */
     function escape($string)
     {
	      return htmlentities($string, ENT_QUOTES, 'UTF-8');
     }
}