<?php 
namespace app\controllers;


use JanKlod\Routing\Controller;
use \HTML;

/**
 * @package app\controllers\NotFoundController
*/
class NotFoundController extends Controller
{
        
        
        /**
         * @var string
        */
        protected $layout = 'error';


		/**
		 * Render page 404
		 * @return mixed 
		*/
	    public function index()
	    {
	    	 HTML::setTitle('Страница не найдена!');
	    	 return $this->render('errors/404');
	    }
}