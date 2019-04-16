<?php 
namespace JanKlod\Database;


/**
 * @package JanKlod\Database\QueryBuilder
 */
class QueryBuilder 
{
      
          /**
           * @var array
          */
          private $sql = [];

        
          /**
           * @var array
          */
          public $values = [];


         

          /**
           * Create Database
           * @param string $name 
           * @return string
          */
          public function createDB($name = 'default')
          {
               $sql = sprintf(
                       "CREATE DATABASE `%s`", 
                       $name
                     );
               return $sql;
          }
        

        /**
         * Create Table if not exist
         * @param string $table 
         * @param string $details 
         * @param string $complements 
         * @return string
        */
        public function createTable($table = 'default', $details = '', $complements = '')
        {
             $sql = sprintf(
                       "CREATE TABLE IF NOT EXIST %s (%s) %s;",
                       $table,
                       $details,
                       $complements
                    );

             return $sql;
        }
        

         /**
          * select fields
          * select('login', 'password')
          * select('login,password')
          * if nothing isnot selected, it'll select all like it "*"
          * 
          * @param string ...$args 
          * @return $this
         */
         public function select(string...$args): self
         {
              $this->remove();
              $this->sql['select'] = QueryRepository::select($args);
         	    return $this;
         }

       
         /**
          * select table
          * @param string|null $table 
          * @return $this
          */
         public function from($table): self
         {
             QueryRepository::checkIfHasTable($table);
             $this->sql['from'] = sprintf('FROM %s ', $table);
             return $this;
         }

       
         /**
          * Conditions
          * where($column, $value, $operator = '=')
          * 
          * @param  string...$args 
          * @return $this
         */
         public function where($column, $value, $operator = '='): self
         {
              $this->sql['where'][] = sprintf('%s %s %s', $column, $operator, '?');
              $this->values[] = $value;
              return $this;
         }

      
        /**
         * Group by query
         * @param string|null $groupBy 
         * @return string
        */
        public function groupBy($groupBy = null)
        {
             $this->sql['group_by'] = sprintf(
                  "GROUP BY %s ",
                  $groupBy
             );

             return $this;
        }
      
        /**
         * Having query
         * @param string|null $havingSql 
         * @return string
        */
        public function having($havingSql = null)
        {
             $this->sql['group_by'] = sprintf(
                   "HAVING %s ",
                   $havingSql
             );

             return $this;
        }

        
        /**
         * Truncate table
         * @param string|null $table 
         * @return string
        */
        public function truncate($table = null)
        {
              $this->remove();
              $this->sql['truncate'] = sprintf(
                         "TRUNCATE TABLE `%s`", 
                         $table
              );

              return $this;
        }


       /**
         * Query Order by
         * orderby('id', 'DESC')
         * 
         * @param $field
         * @param $sort
         * @return $this
       */
       public function orderby(string $field, $sort = 'ASC')
       {
            if(!$field)
            {
                $this->sql['order_by'] = '';
                
            }else{

               $this->sql['order_by'] = sprintf(' ORDER BY %s %s ', $field, $sort);
            }
            return $this;
       }


       /**
        * Limit query
        * limit(1)
        * 
        * @param $number
        * @return $this
       */
       public function limit($number)
       {
            $this->sql['limit'] = sprintf(' LIMIT %s', $number);
            return $this;
       }


       /**
         * Delete query
         * @return $this
       */
       public function delete()
       {
            $this->remove();
            $this->sql['delete'] = 'DELETE ';
            return $this;
       }

       
       /**
        * Update
        * @param string $table 
        * @return $this
       */
       public function update($table)
       {
           QueryRepository::checkIfHasTable($table);
           $this->remove();
           $this->sql['update'] = sprintf('UPDATE %s ', $table);
           return $this;
       }


       /**
        * Insert query
        * insert('users')
        * @param string $table 
        * @return $this
       */
       public function insert($table = null)
       {
             QueryRepository::checkIfHasTable($table);
             $this->remove();
             $this->sql['insert'] = sprintf('INSERT INTO %s ', $table);
             return $this;
       }


       /**
        * Set data 
        * [set] => SET id = ?, name = ?
        * 
        * @param array $data
        * @return $this
       */
       public function set($data = [])
       {
               $this->sql['set'] = 'SET ';

               if(!empty($data))
               {
                    foreach($data as $key => $value)
                    {
                          $this->sql['set'] .= sprintf(' %s = ?,', $key);
                          $this->values[] = $value;
                    }
                   
                    $this->sql['set'] = rtrim($this->sql['set'], ',');
                
               }
              
               return $this;
         }


         /**
            * Build query
            * @return string
          */
          public function sql()
          {
              return QueryRepository::getSql($this->sql);
          }


         /**
          * Remove data
          * @return void
         */
         public function remove()
         {
             $this->sql = [];
             $this->values = [];
         }


          
         /**
         public function __toString()
         {
             return $this->sql();
         }
         **/
}