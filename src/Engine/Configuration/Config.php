<?php 
namespace JanKlod\Configuration;


use JanKlod\Collections\Collection;


/**
 * @package \JanKlod\Configuration\Config 
*/
class Config
{
        

         /**
          * @var array
         */
         private static $stored = [];

        
         /**
          * @var CollectionInterface
         */
         private static $collection;



         /**
          * Config constructor
          * @param array $data
          * @return void
         */
         public function __construct(array $data = [])
         {    
               self::$stored = $data;
               self::$collection = new Collection(self::$stored);
         }

         
         /**
          * Set configuration
          * @param mixed $key 
          * @param mixed $value 
          * @return void
         */
         public function set($key, $value)
         {
               self::$collection->set($key, $value);
         }

         

         /**
          * Get conif by key
          *  (new Config(__YOUR__DATA__))->get('app')
          *  (new Config(__YOUR__DATA__))->get('app.debug')
          * 
          * @param mixed $key 
          * @return mixed
         */
         public function get($key)
         {
             return $this->find($key);
         }


         /**
          * Ensure if has das in container stored
          * @param mixed $key 
          * @return bool
         */
         public function has($key): bool
         {
             return self::$collection->has($key);
         }


         /**
           * append config data in container
           * @param mixed $data
           * @return void
         */
         public function push($data)
         {
             self::$collection->push($data);
         }

         
         /**
          * Get All config stored in $stored
          * @return array
         */
         public function all()
         {
               self::$collection->all();
         }

         
         /**
          * Get config group
          * @param string $name 
          * @return array
         */
         public function group($name='')
         {
              return $this->get($name) ?? [];
         }


         /**
          * Find config item
          * (new Config(__YOUR__DATA__))->find('test.host')
          *  (new Config(__YOUR__DATA__))->find('database.host')
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

                   if(self::$collection->existKey($key))
                   {
                        $config = self::$collection->get($key);

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
