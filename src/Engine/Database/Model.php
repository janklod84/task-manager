<?php 
namespace JanKlod\Database;



/**
 * @package JanKlod\Database\Model
*/
abstract class Model
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
          * @var JanKlod\Database\QueryBuilder
        */
	    protected $queryBuilder;
	     


	    /**
	      * Constructor
	      * @param JanKlod\Container\ContainerInterface $app
	      * @return void
	    */
	    public function __construct($app)
	    {
               $this->db  = $app->db;
               $this->queryBuilder = new QueryBuilder();
	    }
}
