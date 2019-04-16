<?php 
namespace app\controllers\admin;

use app\controllers\BaseController;


use JanKlod\Routing\Controller;
use \Auth;
use app\models\User;
use \HTML;
use \Asset;



/**
 * @package app\controllers\admin
 */
class BackendController extends BaseController
{
        
        
        /**
         * set another layout
         * @var string
        */
        // protected $layout = 'admin';


        /**
         * @var app\models\User
        */
        protected $user;



        /**
         * Constructor
         * @param ContainerInterface $app 
         * @return void
        */
         public function __construct($app)
         {
                parent::__construct($app);
                   
                if(Auth::isLogged())
                {
                    response()->redirect('/');
                }

                $this->user = $this->loadModel('User');
         }
}