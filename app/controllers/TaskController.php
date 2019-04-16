<?php 
namespace app\controllers;

use \Pagination;
use \Form;
use \Token;
use \Session; 
use \Flash;



/**
 * @package app\controllers\TaskController
*/
class TaskController  extends FrontController
{


        /**
         * render index page
         * @return mixed
        */
    	  public function index()
    	  {

              // количества задчиков
              $total   = $this->task->total(); 

              // количество вывода задачика на страницу
              $perpage = $this->config('pagination.perpage'); 

              // получение из GET запроса переменное 'page' если оно есть
              $page = $this->get('page') ? (int) $this->get('page') : 1;
              
              // инициализация пагинацию
              $pagination = new \Pagination($page, $perpage, $total);
              $start = $pagination->getStart();
              
              // также, получение из GET запроса переменное 'sort_by' если она есть
              $sort = $this->get('sort_by') ? (string) $this->get('sort_by') : false;
              
              // вытаскиваем все задачика при условии так как есть пагинация
              $tasks = $this->task->filter("$start, $perpage", $sort);
               
              
              // установление заголовки страницы
              $this->setTitle('Главная');

              // загрузку вида и передачи все необходимые переменные
              // для отображения списки задачиков 
    	  	    $this->render('/task/list', compact('tasks', 'pagination', 'total', 'isChecked'));
    	  }


         /**
           * Create New task
           * Создание новую задачу
           * @return mixed
          */
          public function add()
          {

               // если запрос отправленно POST
               if($this->isPost())
               {
                     if($this->tokenIsMatch())
                     {

                           // Проверяет если валидация прошла успешно
                           if($this->isValidData())
                           {
                                 if($this->checkIfTaskHasCreated())
                                 {

                                    // Установление сообщение об успехе
                                    Flash::message('success', 'Вы успешно создали задачик :)');
                                    
                                    // Перенаправим пользователь на главную странцу
                                    return $this->redirect('/'); 

                                 }

                           }else{
                               
                               // Хранение все ошибки при валидации
                               $this->errors = $this->validation->errors();
                           }
      
                     }
               }
               
               $this->setTitle('Новая задача');
               return $this->form();
          }


          
          /**
           * Edit Task
           * @param int $id
           * @return mixed
          */
          public function edit(int $id = null)
          {
                  if($this->isPost())
                  {
                         if($this->checkIfTaskHasUpdated($id))
                         {
                             // Установливаю сообщение об успехе
                            Flash::message('success', 'Вы успешно обновили задачик :)');
                            
                            // Перенаправим пользователь на главную странцу
                            return $this->redirect('/'); 
                         }
                   }

                 $task = $this->task->findOne($id);
                 $this->setTitle('Редактирование');
                 return $this->form($task); 
          }

        

 
          /**
           * Action Delete Task
           * @param int $id 
           * @return bool
          */
          public function delete(int $id)
          {
                if($this->task->delete($id))
                {
                      // Установливаю сообщение об успехе
                      Flash::message('success', 'Вы успешно удалить задачик :)');
                      return $this->redirect('/');
                }
          }



          /**
           * render form partials
           * @var mixed $task
           * @return string
          */
          private function form($task = null)
          {
              $url = $task ? '/task/edit/'. $task->id : '/task/add';
              $data = $this->post();
              $form = new Form($data);
              $errors = $this->errors;
              $status = $task->status ?? 0;
              $this->render('partials/form', compact('form', 'errors', 'task', 'url', 'status'));
          }


           /**
             * Verify if data match or correctly parse
             * проверяю если у нас валидные данные с Поста
             * при помощью валидатор
             * @return bool
            */
            private function isValidData(): bool
            {
                  
                   // проверка если у нас валидные данные с Поста
                   // при помощью валидатор
                   $validation = $this->validation->check($this->post(), [
                         'username' => [
                             'required' => true,
                             'min' => 3,
                             'max' => 150,
                          ],
                         'email' => [
                             'required' => true,
                             'unique' => 'tasks'
                         ],
                         'text' => [
                             'required' => true
                         ]
                     ]);

                     return $validation->passed();
            }

            
            /**
             * Create Task
             * Check If Task has successfully created
             * @param array $data
             * @return mixed
            */
            private function checkIfTaskHasCreated()
            {
                   return $this->task->insert($this->post());       
            }

            
            /**
             * Update Task
             * And Determine if Task has updated successfully
             * @return mixed
             */
            private function checkIfTaskHasUpdated($id)
            {
                 return $this->task->update($id, $this->post());
            }

}