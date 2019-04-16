<?php 
namespace JanKlod\Database;


use \Exception;
use \PDO;


/**
 * @package JanKlod\Database\ActiveRecord
*/
class ActiveRecord
{

	    /**
          * Name of table
          * @var string
        */
        protected $table;

           
        /**
         * @var primary key
        */
        protected $pk = 'id';

        

	    /**
	      * @var JanKlod\Database\DatabaseManager
	    */
	    protected $db;

        

        /**
         * @var \Statement
        */
        protected $statement;



        /**
          * @var JanKlod\Database\QueryBuilder
        */
	    protected $queryBuilder;
	     


	    /**
	      * Constructor
	      * @param JanKlod\Database\DatabaseManager $db
	      * @return void
	    */
	    public function __construct($db)
	    {
               $this->db  = $db;
               $this->queryBuilder = new QueryBuilder();
	    }

        
        /**
         * @return QueryBuilder
        */
        protected function makeQuerySelect($table = null)
        {
            $table = $table ?: $this->table;
            return $this->queryBuilder
                        ->select()
                        ->from($table);
        }

        
        /**
         * Fetch Factory
         * @param string $sql 
         * @param string $one [ 'll change after $one by $type for fetchColumn, ..]
         * @return mixed
        */
        protected function fetch($sql, $one = false)
        {
             $this->statement = $this->db->query($sql, $this->queryBuilder->values);
             
             if($one === true)
             {
                return $this->statement->fetch();
             }

             return $this->statement->fetchAll();
        }


        /**
         * Return all records from table
         * @return null|array
        */
        public function findAll()
        {
             $sql = $this->makeQuerySelect()->sql();
             return $this->fetch($sql);
        }

        

        /**
          * Query with Where 
          * @param type $value 
          * @param type|string $table 
          * @param type|string $pk 
          * @return type
       */
       private function where($value , $table, $pk = '')
       {
            return $this->makeQuerySelect($table)
                        ->where($pk, $value)
                        ->sql();

       }


       /**
        * Get item like find but it special for detemine unique
        * @param type $table 
        * @param type $pk 
        * @param type $value 
        * @return type
       */
       public function find($table, $pk, $value)
       {
            $sql = $this->where($value, $table, $pk);
            return $this->fetch($sql, true);
       }



        /**
         * Return one record from table
         * @param int $pk
         * @return null|array
        */
        public function findOne($pk = 0)
        {
              $sql = $this->makeQuerySelect()
                          ->where($this->pk, $pk)
                          ->limit(1)
                          ->sql();

             return $this->fetch($sql, true);
        }


        /**
         * insert new record
         * @param array $data 
         * @return mixed
        */
        public function insert($data = [])
        {
             try
             {
             	      $sql = $this->queryBuilder
                                ->insert($this->table)
                                ->set($data)
                                ->sql();
            
            	    return $this->db->query($sql, $this->queryBuilder->values);

             }catch(Exception $e){

             	 die($e->getMessage());
             }
        }
        
        /**
         * Update record 
         * @param mixed $pk 
         * @param array $data 
         * @return mixed
        */
        public function update($pk, $data = [])
        {
              try 
	            {
	                 $sql = $this->queryBuilder
                           		 ->update($this->table)
                           		 ->set($data)
                           		 ->where($this->pk, $pk)
                           		 ->sql();
                   
	                 return $this->db->query($sql, $this->queryBuilder->values);

	            }catch(Exception $e){

	            	exit($e->getMessage());
	            }
        }



        
       /**
        * Delete item from data
        * @param int $id 
        * @return bool
       */
        public function delete($id)
        {
             try 
             {
                    $sql = $this->queryBuilder
                                ->delete()
                                ->from($this->table)
                                ->where($this->pk, $id)
                                ->sql();

                    return $this->db->query($sql, $this->queryBuilder->values);

             }catch(PDOException $e){

                  exit($e->getMessage());
             }
        }
        

         /**
          * Save record in to database
          * @return mixed
         */
         public function save(){}

}