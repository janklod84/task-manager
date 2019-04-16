<?php 
namespace JanKlod\Database;


use \PDO;
use \PDOException;


/**
 * This class manage connection to database
 * @package JanKlod\Database\Connection 
*/
class Connection
{


        /**
          * prevent instance from being cloned
          * @return void
        */
        private function __clone(){}

   

        /**
          * prevent instance from being unserialized
          * @return void
        */
        private function __wakeup(){}

        
        /**
         * Constructor
         * @return void
        */
        private function __construct(){}
  
        

        /**
         * Get connection to PDO
         * @param array $config
         * @return \PDO
         * @throws \PDOException
        */
	    public static function make(array $config = [])
	    {
             if(empty($config)) { return null; }

             try 
             {
                  return new PDO(
                 	     $config['dsn'], 
                 	     $config['user'], 
                 	     $config['password'], 
                 	     $config['options']
                  );
             
             }catch(PDOException $e){

             	 die('Error connection');
             }
	    }

}