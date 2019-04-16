<?php 
namespace JanKlod\Database;

use \PDO;
use \PDOStatement;


/**
 * @package JanKlod\Database\Statement
*/
class Statement
{
	
  		   /**
  		    * @var \PDO
  		   */
  		   private $connection;
	      

	       /**
	        * @var \PDOStatement
	       */
	       private $stmt;

        
          /**
           * @var array
          */
          private $resultQuery = [];


          /**
           * @var array
          */
          private $params = [];


          
          /**
            * Constructor
            * @param \PDO $connection
            * @return void
          */
  	      public function __construct(PDO $connection)
  	      {
                   $this->connection = $connection;
  	      }

         
      	 /**
       	   * Query
       	   * @param string $sql
       	   * @param array $params
       	   * @return \PDOStatement
      	 */
	      public function query($sql, $params = []): self
	      {
	             if(!empty($params))
	             {
	             	    $this->stmt = $this->connection->prepare($sql);
                    $this->params = $params;
                    
	             }else{

	             	     $this->stmt = $this->connection->query($sql);
	             }

	             return $this;
	      }


        /**
         * Execute query
         * @return \PDOStatement
         * @throws \PDOException
        */
        public function execute()
        {
             if(!empty($this->params))
             {
                  try 
                  {
                      $this->stmt->execute($this->params);

                  }catch(PDOException $e){

                      exit($e->getMessage());
                  }
             }

             return $this->stmt;
        }
   

        /**
         * Return all records from table
         * @return mixed
        */
        public function fetchAll()
        {
            $this->resultQuery = $this->execute()->fetchAll();
            return $this;
        }


        /**
         * Return one record from table
         * @return mixed
        */
        public function fetch()
        {
            $this->resultQuery = $this->execute()->fetch();
            return $this;
        }

        
        /**
         * Return array
         * @return mixed
        */
        public function result()
        {
             return $this->resultQuery ?: [];
        }

}