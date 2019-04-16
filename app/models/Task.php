<?php 
namespace app\models;


use \Pagination;

/**
 * @package app\models\Task
*/ 
class Task extends BaseModel
{

      
        /**
         * name table
         * @var string
        */
        protected $table = 'tasks';


        /**
            * Primary key
            * @var string
        */
        protected $pk = 'id';
        
        
        /**
         * Get count of tasks records
         * @return int
        */
        public function total()
        {
            return count($this->findAll());
        }

        
        /**
         * Filter variables
         * @param type $start 
         * @param type $perpage 
         * @param type $sort 
         * @return type
        */
        public function filter($limit, $sort)
        {
                $sort = str_replace(['name', 'user-status'], ['username', 'status'], $sort);
                if(is_numeric($sort)) { $sort = false; };

                $sql = $this->makeQuerySelect()
                            ->orderby($sort)
                            ->limit($limit)
                            ->sql();
                return $this->fetch($sql);
        }


        /**
          * Create Task
          * @param array $data 
          * @return mixed
        */
        public function insert($data = [])
        {
            unset($data['_csrf']);
            return parent::insert($data);
        }


       /**
        * Update Task
        * @param int $id 
        * @param array $data 
        * @return bool
      */
       public function update($id, $data = [])
       {
            unset($data['_csrf']);
            return parent::update($id, $data);
       }
     
}