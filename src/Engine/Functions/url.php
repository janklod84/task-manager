<?php 
use JanKlod\Http\Request;
use JanKlod\Routing\Route;



if(!function_exists('base_url'))
{
      
      /**
       * Return current base URL if user active it
       * @param string|null $current 
       * @return mixed
      */
      function base_url(string $current = '')
      {
      	  if($current) { return $current; }
      	  elseif($current === false) { return false; }
      	  else{ return (new Request())->baseUrl(false); }
      }
}



if(!function_exists('url'))
{
	 /**
	  * fonction Url Generator
	  * Here it's include both method 
	  * Route::url('/test/path') or Url::to('/test/path')
	  * 
	  * @param type $name 
	  * @param type|array $params 
	  * @return type
	 */
	 function url($name = '', $params = [])
	 {
	 	  return Route::url($name, $params);
	 }
}