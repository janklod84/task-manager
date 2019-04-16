<?php 
namespace app\providers;


/**
 * @package app\providers\TaskProvider 
*/
class TaskProvider  extends BaseProvider
{
       /**
        * Register service provider [ Testing ]
        * @return void
        */
	   public function register()
	   {
	   	    $this->app->set('task', function () {
                return $this->app->load->model('Task');
	   	    });
	   }
}