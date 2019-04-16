<?php 
namespace JanKlod\Database;


/**
 * @package JanKlod\Database\QueryRepository 
*/ 
class QueryRepository
{
        
        /**
         * select fields
         * @param mixed $parses 
         * @return string
        */
	    public static function select($parses)
	    {
	    	 if(!empty($parses))
	    	 {
	    	 	 $fields = '`'. implode('`,`', array_values($parses)) . '`';

	    	 }else{

	    	 	$fields = "*";
	    	 }

	    	 return sprintf('SELECT %s ', $fields);
	    }


        
        /**
         * Check if has table
         * @param string $table 
         * @return string
         */
	    public static function checkIfHasTable($table)
	    {
	    	   if(is_null($table))
               {
                   exit('Table name is required!');
               }
	    }

        
        /**
         * Get setted data
         * @param array $data 
         * @return string
        */
	    public static function getData($data, $values)
	    {
	    	   $set = 'SET ';

	    	   if(!empty($data))
	           {
	                foreach($data as $key => $value)
	                {
	                      $set .= sprintf(' %s = ?,', $key);
	                      $values[] = $value;
	                }
	               
	                $set = rtrim($set, ',');
                    return $set;
	           }
              
	    }


        /**
         * Get sql
         * @param array $sql 
         * @return string
        */
	    public static function getSql($sql)
	    {
	    	    $output = '';

                if(!empty($sql))
                {
                    foreach ($sql as $key => $value)
                    {
                         if($key == 'where')
                         {
                            $output .= ' WHERE ';

                            foreach ($value as $where)
                            {
                                 $output .= $where;

                                if(count($value) > 1 and next($value))
                                {
                                    $output .=' AND ';

                                 } // endif

                             }//endforeach

                         } else{
                             
                             $output .= $value;

                        }// end if where

                    } // end foreach

                } // end if

              return $output; 
	    }

}