<?php 
namespace app\models;


use \Session;


/**
 * @package app\models\User
*/
class User extends BaseModel
{
            

           /**
             * Table name
             * @var string
           */
            protected $table = 'users';

       
            /**
            * Primary key
            * @var string
            */
            protected $pk = 'id';

            
            

             /**
               * Determine if find one user from database
               * @param string $username 
               * @param string $password 
               * @return bool
             */
             public function login($username, $password)
             {
                    $sql = $this->queryBuilder
                                ->select()
                                ->from($this->table)
                                ->where('username', $username)
                                ->limit(1)
                                ->sql();
                
                      $stmt = $this->db->query($sql, $this->queryBuilder->values);

                      $user = $stmt->fetch();

                      if($user)
                      {
                          if(password_verify($password, $user->password))
                          {
                               Session::put('sess.user', $user);
                               return true;
                          }
                      }

                      return false;
          }

}