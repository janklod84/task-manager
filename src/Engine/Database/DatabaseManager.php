<?php 
namespace JanKlod\Database;


use \PDO;


/**
 * @package JanKlod\Database\DatabaseManager
*/
class DatabaseManager
{

            /**
             * @var \PDO
            */
            private static $connection;

            
            /**
             * @var Statement
            */
            private $statement;


            /**
             * Constructor
             * @param array $config
             * @return void
            */
            public function __construct(array $config = [])
            {
                  self::$connection = Connection::make($config);
                  $this->statement  = new Statement(self::$connection);
            }


            /**
             * Get statement
             * @return Statement
            */
            public function statement()
            {
                 return $this->statement;
            }

            
            /**
             * Get connection to Database
             * @return \PDO
            */
            public static function connect()
            {
                 return self::$connection;
            }


            /**
             * This method is Factory method query and prepare
             * If you have params it will execute method prepare
             * If haven't params it's will execute method query
             * 
             * Ex:
             * $db = new Database(config);
             * $db->query('SELECT * FROM your_table WHERE param1 = ? AND param2 = ?', [ 'param1' => 'value1', 'param2' => 'value2' ]);
             * 
             * @param string $sql
             * @param array $params
             * 
             * @return null|\PDOStatement
            */
            public function query($sql, $params = [])
            {
                 return $this->statement
                             ->query($sql, $params)
                             ->execute();
            }

            
            /**
             * @param int $attribute
             * @param mixed $value
             * @return bool
            */
            public function setAttribute($attribute, $value): bool
            {
                 return self::$connection->setAttribute($attribute, $value);
            }

            
            /**
             * Return query last insert id 
             * @return int
            */
            public function lastId(): int
            {
                return (int) self::$connection->lastInsertId();
            }   


            /**
             * Begin transaction
             * @param string $sql 
             * @return bool
            */
            public function transaction()
            {
                 return self::$connection->beginTransaction();
            }
            

            /**
             * Roolback
             * @return bool
            */
            public function rollBack()
            {
                 return self::$connection->rollBack();
            }

            
            /**
             * Commit
             * @return bool
            */
            public function commit()
            {
                 return self::$connection->commit();
            }



            /**
             * Close current connection
             * @return void
            */
            public function close()
            {
                  self::$connection = null;
            }

}