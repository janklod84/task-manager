<?php 
namespace JanKlod\Http;


/**
 * @package JanKlod\Http\Server 
*/ 
class Server 
{
        
        /**
         * @var GlobalStrategy
        */
        private $repository;


        /**
         * Constructor
         * @return void
        */
        public function __construct()
        {
             $this->repository = new GlobalStrategy(Repository::storage('server'));
        }



        /**
         * Get Protocol server
         * @return type
        */
        public function protocol()
        {
             return $this->fromGlobals('SERVER_PROTOCOL');
        }

        
        /**
         * Return port used by server
         * @return string
        */
        public function port()
        {
             return $this->fromGlobals('SERVER_PORT'); 
        }


        /**
         * Return document root of server
         * @return string
        */
        public function root()
        {
             return $this->fromGlobals('DOCUMENT_ROOT'); 
        }
      

        /**
          * Get Server SCHEME
          * @return string
        */
        public function scheme()
        {
              return $this->fromGlobals('REQUEST_SCHEME');
        }


        /**
         * Get arguments in mode cli
         * @return ?array
        */
        public function cli($type = 'argv')
        {
            return $this->fromGlobals($type);
        }


        /**
         * Get request Uri
         * @return string
        */
        public function uri()
        {
            return $this->fromGlobals('REQUEST_URI');
        }


        /**
         * Return query string
         * @param bool $trim 
         * @return string
        */
        public function queryString($trim = false)
        {
            $qs = $this->fromGlobals('QUERY_STRING');

            if($trim === true) 
            { 
                return rtrim($qs, '/');

            }else{ 

                return $qs;
            }
        }

        
        /**
         * Determine ajax
         * @return type
        */
        public function ajax()
        {
            return $this->fromGlobals('HTTP_X_REQUESTED_WITH');
        }


        /**
         * Return request method
         * @return string
        */
        public function method()
        {
            return $this->fromGlobals('REQUEST_METHOD');
        }

        /**
         * Get User ip
         * Get the direct ip for user [1]
         * Get if user uses proxy     [2]
         * Get the direct ip for user [1]
         * @return string
        */
        public function ip()
        {
        	 $ip = $this->fromGlobals('REMOTE_ADDR'); // [1]

        	 if($this->fromGlobals('HTTP_CLIENT_IP')) // [2]
        	 {
        	 	    $ip = $this->fromGlobals('HTTP_CLIENT_IP');

        	 }elseif($this->fromGlobals('HTTP_X_FORWARDED_FOR')){

        	 	    $ip = $this->fromGlobals('HTTP_X_FORWARDED_FOR');
        	 }

        	 return $ip;
        }


        /**
         * Return server host
         * @return string
        */
        public function host(): string
        {
             return $this->fromGlobals('HTTP_HOST');
        }

        
        /**
         * Return secure protocol
         * @return string
        */
        public function https()
        {
            return $this->fromGlobals('HTTPS');
        }

        
        /**
         * Determine data from superglobal
  		 * Factory method
         * @param string $key 
         * @return mixed
        */
        public function fromGlobals($key = null)
        {
            return $this->repository->find($key);
        }
        

}