<?php 
namespace JanKlod\Http;


use JanKlod\Http\Message\RequestInterface;

/**
 * @package JanKlod\Http\Request 
*/ 
class Request implements RequestInterface
{
         
         /**
          * @var Server
         */
         private $server;

         
         /**
          * @var 
         */
         private $currentUrl;


         /**
          * Constructor
          * @return void
         */
         public function __construct($currentUrl = null)
         {
              $this->server = new Server();
              $this->currentUrl = $currentUrl;
         }

         
         /**
          * Get allowed data from Repository
          * @param string $key 
          * @return mixed
         */
         public function fromGlobals($key = null)
         {
              return new GlobalStrategy(Repository::storage($key));
         }

         
         /**
          * Determine base URL with URI by default,
          * like this http://framework.loc/ 
          * But if $uri = false, http://framework.loc without URI
          * @return string
         */
         public function baseUrl($uri = true)
         {
             return implode($this->urlParams($uri));
         }

         
         /**
          * Determine details from url
          * Ex:
          * $url = 'http://framework.loc/posts/number-2';
          * $this->details($url); ...
          * 
          * @param string $url
          * @return array
         */
         public function details($url)
         {
             return parse_url($url);
         }


         /**
          * Return data from request $_GET
          * If $key not null, it'll return setted item
          * $this->get() ==> return $_GET
          * $this->get('url') return $_GET['url'] if isset url
          * 
          * @param string $key 
          * @return mixed
         */
         public function get($key = null)
         {
             return $this->fromGlobals('get')->find($key);
         }

         
         /**
          * Return data from request $_POST
          * @param string $key 
          * @return mixed
         */
         public function post($key = null)
         {
             return $this->fromGlobals('post')->find($key);
         }


         /**
          * Return data from request $_REQUEST
          * @param string $key
          * @return mixed
         */
         public function request($key = null)
         {
             return $this->fromGlobals('request')->find($key);
         }


         /**
          * Return data from request $_FILES
          * @param string $key 
          * @return array
         */
         public function files($key = null)
         {
             return $this->fromGlobals('file')->find($key);
         }


         /**
          * Return data from request $_COOKIE
          * @param string $key 
          * @return array
         */
         public function cookies($key = null)
         {
             return $this->fromGlobals('cookie')->find($key);
         }

        
         /**
          * Return server request method
          * @return type
         */
         public function method()
         {
              return $this->server->method();
         }


         /**
          * Return server request uri
          * @return type
         */
         public function uri()
         {
             return $this->server->uri();
         }


         /**
          * Return server request cli
          * @return type
         */
         public function cli($type = 'argv')
         {
             return $this->server->cli($type);
         }



         /**
          * Return query string
          * @param bool $trim 
          * @return string
         */
         public function queryString($trim = false)
         {
             return $this->server->queryString($trim);
         }

         
        
         /**
          * Return server
          * @param string $key 
          * @return mixed
         */
         public function server($key = null)
         {
             return $this->server->fromGlobals($key);
         }


         /**
          * Determine if request method is POST
          * @return bool
          */
         public function isPost(): bool
         {
             return $this->method() === 'POST';
         }


         /**
          * Determine if request method is GET
          * @return bool
          */
         public function isGet(): bool
         {
             return $this->method() === 'GET';
         }


         /**
          * Determine if request method by AJAX
          * @return bool
         */
         public function isAjax(): bool
         {
             return $this->server->ajax() === 'XMLHttpRequest';
         }


         /**
          * Determine if has match url
          * @return bool
         */
         public function is_baseUrl(): bool
         {
             return $this->currentUrl === $this->baseUrl();
         }


         /**
          * Determine if current scheme is secure
          * @return bool
          */
         public function is_secure()
         {
             return $this->server->https() == 'on';
         }

         
         /**
           * Determine if current request is cli
           * @return type
         */ 
         public function is_cli() 
         {
             return $this->server->cli('argc') > 0
                    || php_sapi_name() === 'cli';
         }


         /**
          * 
          * @param bool $uri 
          * @return string
         */
         private function urlParams($uri)
         {
             return [
                  $this->server->scheme() . '://',
                  $this->server->host(),
                  !$uri ? '' : $this->server->uri()
            ];

         }
         
}