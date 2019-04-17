<?php 
namespace JanKlod\Routing;



/**
 * @package JanKlod\Routing\Controller 
*/ 
abstract class Controller 
{
        
        /**
         * @var ContainerInterface
        */
        protected $app;

        
        /**
         * Layout 
         * @var string
        */
        protected $layout;
       
        
        /**
         * @var ViewInterface
        */
        protected $view;


        /**
         * @var RequestInterface
        */
        protected $request;
       

        /**
         * Constructor
         * @param ContainerInterface $app 
         * @return void
        */
	    public function __construct($app)
	    {
	    	  $this->app   =  $app;
	    	  $this->view  =  $this->app->get('view');
              $this->request =  $this->app->get('request');
	    }

        

        /**
         * Render view
         * @return mixed
        */
	    protected function render($viewPath, $data = [])
	    {     
	    	  $this->view->setLayout($this->layout);
              $this->view->render($viewPath, $data);
	    }

        
        /**
         * Get config
         * @param string $key 
         * @return mixed
        */
        protected function config($key)
        {
            return $this->app->config->get($key);
        }


        /**
         * Load model [Get model instance]
         * @param string $name 
         * @return object
        */
        protected function loadModel($name)
        {
              return $this->app->load->model($name);
        }


        /**
         * Find data from post request
         * @param string $key 
         * @return mixed
        */
        protected function post($key = null)
        {
            return $this->request->post($key);
        }


        /**
         * Find data from get request
         * @param string $key 
         * @return mixed
        */
        protected function get($key = null)
        {
            return $this->request->get($key);
        }


       /**
         * Determine if method is Get Request
         * @return type
        */
        protected function isGet()
        {
            return $this->request->isGet();
        }


        /**
         * Determine if method is Post request
         * @return type
        */
        protected function isPost()
        {
            return $this->request->isPost();
        }



        /**
         * Determine if method is Ajax request
         * @return type
        */
        protected function isAjax()
        {
            return $this->request->isAjax();
        }


        
        /**
         * Get data has json
         * @param array $data 
         * @return string
        */
        protected function json(array $data = [])
        {
        	 return json_encode($data);
        }


        /**
         * Redirect to page with header Location
         * @param string $to [path to redirect] 
         * Ex: [ $this->redirect('/users/')]
         * @return mixed
        */
        protected function redirect($to = '')
        {
              return response()->redirect($to);
        }


        /**
         * Get Language
         * @param string $code [code language like = ru, en , fr]
         * @return string
        */
        protected function getLanguage($code = 'en')
        {
              $code = trim($code, '/');
              $currentLanguage = $this->app->config->get('app.language');
              
              $codePath = $code ?: $currentLanguage;
              
              if(!empty($codePath))
              {
                 $path = "app/lang/{$codePath}/translate.php";
                 if($this->app->file->exists($path))
                 {
                     return $this->app->file->call($path);
                 }
              }
        }


}