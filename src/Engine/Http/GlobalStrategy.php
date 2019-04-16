<?php 
namespace JanKlod\Http;



/**
 * @package JanKlod\Http\GlobalStrategy 
*/ 
class GlobalStrategy
{
      
      
      /**
       * @var CollectionInterface
      */
      private $collection;


      /**
       * Constructor
       * @param CollectionInterface $collection 
       * @return void
      */
      public function __construct($collection)
      {
            $this->collection = $collection;
      }


       /**
         * Return data from global $_SERVER
         * @param string $key
       */
  	   public function find($key = null)
  	   {
  	         if(is_null($key))
  	         {
  	         	   return $this->collection->all();
  	         }

  	         return $this->has($key) ? $this->collection->get($key) : null;
  	   }


        /**
          * Determine if key exist in superglobal $_SERVER
          * @param string $key
          * @return bool [ return isset($_SERVER[$key]) ]
        */
        public function has($key): bool
        {
             return $this->collection->has($key);
        }

}