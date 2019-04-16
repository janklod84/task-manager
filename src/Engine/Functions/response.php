<?php 

use JanKlod\Http\Response;


if(!function_exists('redirect'))
{

	  /**
	   * Redirect user another page
	   * Ex: redirect('http://www.google.com');
	   * 
	   * @param string $path 
	   * @return string
	   */
	  function redirect($path = '/') 
	  {
		   if (!headers_sent())
		   {
		       header(sprintf('Location: %s', $path));

		   }else{

		       echo '<script type="text/javascript">';
		       echo sprintf('window.location.href="%s"', $path);
		       echo '</script>';
		       echo PHP_EOL;
		       echo '<noscript>';
		       echo sprintf('<meta http-equiv="refresh" content="0;url=%s"/>', $path);
		       echo '</noscript>';
		       echo PHP_EOL;
		   }
      }
}



if(!function_exists('response'))
{
	 /**
	  * Check Response object
	  * @return Response
	 */
	 function response($status = 200, $content = null, $headers = [])
	 {
	 	 return new Response($content, $status, $headers);
	 }
}



if(!function_exists('notFound'))
{
	 /**
       * Return not found page
       * @return void
     */
     function notFound()
     {
     	 return response()->redirect(\JanKlod\Routing\RouteHandler::getNotFound());
     }


}