<?php 
namespace JanKlod\Common;


/**
 * @package JanKlod\Common\Redirect
 */
class Redirect
{
       /**
        * @param string $path
       */
	   public function to(string $path)
	   {
	   	   response()->redirect($path);
	   }
}