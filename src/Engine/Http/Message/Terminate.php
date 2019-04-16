<?php 
namespace JanKlod\Http\Message;
	


/**
 * This class like Request Handler Interface
 * @package JanKlod\Http\Message\Terminate
*/
interface Terminate
{
	  /**
	   * Break Point
       * Handle intermediate beetwen request and response
       * @param RequestInterface $request 
       * @return ResponseInterface
      */
	  public function handle(RequestInterface $request): ResponseInterface;
}