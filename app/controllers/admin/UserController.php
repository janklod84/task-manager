<?php 
namespace app\controllers\admin;


use \Form;
use \HTML;
use \Token;
use \Session;
use \Flash;


/**
 * @package app\controllers\admin\UserController
 */
class UserController extends BackendController
{
        
	        /**
	         * render login admin
	         * @return mixed
	        */
	        public function login()
	        {

	             $this->layout = 'admin';

                 // Проверка метод отправки данные тут ожидаем , метод пост
	             if($this->isPost())
	             {
                       // проверяю наличе Токен
	             	   if($this->tokenIsMatch())
	             	   {
                             // Проверяем валидности данные
                             if($this->isValidData())
                             {
                                   // Проверяем нашли пользователь соответвующий логин и пароль
                             	   // если нашел то храняем текущий пользователь в Сессии
                             	   // и вернем true , а в противом случае вернем false
                             	   if($this->isLogged())
                             	   {
                             	   	    
                                     // Установление сообщение об успехе
                                     Flash::message('success', 'Вы успешно авторивован :)');
                                     
                                     // Редирект на главную страницу если 
                             	   	 $this->redirect('/');

                             	   }

                             }else{

                             	  $this->errors = $this->validation->errors();
                             }
	             	   }
	             }
                 
                 // вывод форму
	             $this->form();
	        }


            
            /**
             * Verify if data match or correctly parse
             * проверяю если у нас валидные данные с Поста
	         * при помощью валидатор
             * @return bool
             */
            private function isValidData(): bool
            {
	               $validation = $this->validation->check($this->post(), [
	                   'username' => ['required' => true],
	                   'password' => ['required' => true]
	               ]);

	               return $validation->passed();
            }

            
            /**
             * Verify if find correspondant user 
             * @return bool
            */
            private function isLogged(): bool
            {
        	     // получаю данные с Поста
                 $username = $this->post('username');
                 $password = $this->post('password');
               
                 // Получаю с БД если есть такой пользователь
                 return $this->user->login($username, $password);                  
            }
            

	       

	        /**
	         * Factory render form
	         * Приватный метод для выхода формы
	         * @param array $errors
	         * @return string
	        */
	        private function form()
	        {
		             // Инициализую Library для работы с Формами
		             $dataForm = $this->post();
		             $form = new Form($dataForm);
                     $errors = $this->errors;

		             // Утановление заголовок страницы
					 $this->setTitle('Вход');

		             // Загрузку страниу и передачи качествые параметры в виде
		    	     $this->render('admin/user/login', compact('form', 'errors'));
	        }


}