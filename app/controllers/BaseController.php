<?php 
namespace app\controllers;


use JanKlod\Routing\Controller;
use \HTML;
use \Asset;
use \Token;
use \Session;


/**
 * @package app\controllers\FrontController 
*/ 
class BaseController extends Controller
{
   

       /**
         * @var Validation
       */
       protected $validation;

       

       /**
         * storage errors
         * @var array
       */
       protected $errors;


       /**
        * Constructor
        * @param ContainerInterface $app 
        * @return void
       */
       public function __construct($app)
       {
       	    parent::__construct($app);

       	    // Установление общие мета данных для вида
            HTML::addMeta([
                'viewport' => 'width=device-width, initial-scale=1, shrink-to-fit=no',
	              'description' => '',
	              'author' => ''
            ]);
            
            
            $this->task = $this->loadModel('Task');
            $this->validation = $this->app->get('validate');

            // Добавление мини-транслатор (переводчик) с англ-русского языка
            $this->validation->addTranslation($this->getLanguage('ru'));
            
            // Установление имени приложения [ set application name ]
            HTML::addName($this->config('app.name'));

            // Установление все необходимые параметеры для вывода стилей и скриптов
            Asset::append($this->config('asset'), $this->config('app.base_url'));
       }

       
       /**
        * set title
        * @param string $title 
        * @return string
       */
       protected function setTitle($title)
       {
            HTML::setTitle($title, $this->config('app.name'));
       }


       /**
        * Determine if has Token and if is match
        * @return bool
       */
       protected function tokenIsMatch(): bool
       {
            return Token::check($this->post('_csrf'));
       }


       /**
          * Logout
          * @return void
       */
       public function logout()
       {
           if(Session::has('sess.user'))
           {
                 Session::remove('sess.user');
                 Session::clear();
                 return $this->redirect('/');
           }
       }


}