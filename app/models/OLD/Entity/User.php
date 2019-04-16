<?php 
namespace app\models\Entity;


class User
{
            
            
	      public $id;
	      public $username;
            public $password;
            public $role;
      

      
            public function setId($id)
            {
                  $this->id = $id;
            }


            public function getId()
            {
      	     return $this->id;
            }

            public function setUsername($username)
            {
            	  $this->username = $username;
            }


            public function getUsername()
            {
            	  return $this->username;
            }


            public function setPassword($password)
            {
            	  $this->password = $password;
            }


            public function getPassword()
            {
            	  return $this->password;
            }


            public function setRole($role)
            {
                 $this->role = $role;
            }


            public function getRole()
            {
            	  return $this->role;
            }

}