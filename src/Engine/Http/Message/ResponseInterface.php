<?php 
namespace JanKlod\Http\Message;


/**
 * @package JanKlod\Http\Message\ResponseInterface 
*/
interface ResponseInterface 
{
       
       /**
        * Send to server headers and body
        * @return void
       */
	   public function send();
}