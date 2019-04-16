<?php 
namespace app\controllers;


/**
 * @package app\controllers\FrontController 
*/ 
class FrontController extends BaseController
{
       
       /**
        * @var app\models\Task
       */
       protected $task;



       /**
        * Constructor
        * @param ContainerInterface $app 
        * @return void
       */
       public function __construct($app)
       {
       	    parent::__construct($app);
            $this->task = $this->loadModel('Task');
       }
}