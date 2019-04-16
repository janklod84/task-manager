<?php 
use JanKlod\Encryption\Token;


if(!function_exists('csrfToken'))
{
      
      /**
       * Generator token against failles Csrf
       * @return string
      */
	  function csrfToken()
	  {
           return Token::generate();
	  }

}