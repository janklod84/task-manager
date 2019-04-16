<?php 
namespace app\models\Manager;


use app\models\Entity\User;


/**
 * @package app\models\Manager\UserManager 
*/ 
class UserManager extends BaseManager
{
        
         /**
          * Table name
          * @var string
         */
         protected $table = 'users';

         
         /**
          * @var string
         */
         protected $entity = "Entity\\User";


         /**
          * Primary key
          * @var string
         */
         protected $pk = 'id';


        /**
         * Return all records from table
         * @return null|array
        */
        public function getUsers()
        {
             return $this->findAll();
        }


        /**
         * Find user by Id
         * @return mixed
        */
        public function findUserById()
        {
            return $this->findOne(3);
        }

        
        public function createUser()
        {
            $user = new User();
            $user->setUsername('ddddd');
            $user->setPassword('qwerty');
            $user->setRole('1');
        }


        /**
         * 
         * @return type
        */
        public function saveUser()
        {
              $user = new User();
              $user->setId(6);
              
        }
}