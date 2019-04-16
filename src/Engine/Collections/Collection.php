<?php 
namespace JanKlod\Collections;



/**
 * @package JanKlod\Collections\Collection 
*/ 
class Collection  implements CollectionInterface
{
	  

	    /**
         * @var array
        */
        private $items;


        
        /**
         * Constructor
         * @param array $items 
         * @return void
        */
        public function __construct(array $items = [])
        {
        	 $this->items = $items;
        }


        /**
         * Add items
         * @param array $items 
         * @return void
        */
        public function addItems(array $items = [])
        {
              $this->items = $items;
        }


        /**
         * Set item by key
         * @param mixed $key
         * @param mixed $value
         * @return void
        */
        public function set($key, $value)
        {
             $this->items[$key] = $value;
        }
		
		

        /**
         * Get item by key
         * @param $key
         * @return mixed|null
        */
        public function get($key)
        {
             return $this->items[$key];
        }


        /**
         * Determine wether key isset in container items
         * @param string $key
         * @return bool
        */
        public function has($key)
        {
             return isset($this->items[$key]);
        }

        
        /**
         * Determine if key exist in items collections
         * @param mixed $key 
         * @return type
        */
        public function existKey($key)
        {
             return array_key_exists($key, $this->items);
        }


        /**
         * Get all items collection
        */
        public function all()
        {
            return $this->items ?? [];
        }


        /**
         * Merge items in collection
         * @param array $items 
         * @return void
        */
        public function merge($items)
        {
        	 $this->items = array_merge($this->items, $items);
        }


        /**
         * Push data in current items
         * @param array $items 
         * @return type
        */
        public function push($items)
        {
             array_push($this->items, $items);
        }


        /**
         * Remove item by key
         * 
         * @param string $key 
         * @return void
        */
        public function remove($key)
        {
             if($this->has($key))
             {
                  unset($this->items[$key]);
             }
        }

        
        /**
         * Get count items
         * @return int
        */
        public function count()
        {
            return count($this->items);
        }


         /**
          * Find  item 
          * This method resume get() it more advanced than get method
          * 
          * (new Collection(__YOUR__DATA__)->find('app.item')
          * (new Config(__YOUR__DATA__))->find('app.debug')
          * 
          * @param string $path 
          * @return mixed
         */
         public function find($path)
         {
               if($path)
               {
                   $path = explode('.', $path);
                   $key = $path[0];

                   if($this->existKey($key))
                   {
                        $config = $this->get($key);

                        foreach($path as $item)
                        {
                            if(isset($config[$item]))
                            {
                                $config = $config[$item];
                            }
                        }

                        return $config;
                   }

               }
               return false;
             
         }
}