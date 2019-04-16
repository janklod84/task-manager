<?php 
namespace JanKlod\Routing;


use JanKlod\Http\Message\RequestInterface;

/**
 * @package JanKlod\Routing\RouterInterface
*/ 
interface RouterInterface 
{
	 /**
       * Dispacth routes
       * @param RequestInterface $request 
       * @return mixed
      */
	  public function dispatch(RequestInterface $request);
}