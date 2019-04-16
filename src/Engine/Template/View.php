<?php 
namespace JanKlod\Template;


/**
 * @package JanKlod\Template\View 
*/ 
class View 
{
          
          /**
           * @const string
          */
          private $basePath = 'app/views/%s.php';


          /**
           * @var \JanKlod\Container\ContainerInterface
          */
          private $app;


          /**
           * @var string
          */
          private $layout;


          
          /**
           * @var string
          */
          private $view;

          

          /**
           * @var File
          */
          private $file;


          
          /**
           * @var array
          */
          private $data = [];


          
	      /**
	       * Constructor
	       * @param \JanKlod\Container\ContainerInterface $app 
	       * @return void
	       */
	      public function __construct($app)
	      {
                $this->app  = $app;
                $this->file = $app->file;
	      }


        /**
          * Set layout name
          * @param string $layout 
          * @return void
        */
	      public function setLayout($layout = null)
	      {  
            if($layout === false)
            {
                $this->layout = false;

            }else{

                $this->layout = trim($layout, '/') ?: $this->configLayout();
            }
            
	      }

          
        /**
         * Get name current layout
         * @return type
        */
        public function getLayout()
        {
             return $this->layout;
        }



	      /**
          * Set view path
          * @param string $layout 
          * @return void
        */
	      public function setViewPath($view = '')
	      {
	      	    $this->view = trim(str_replace('.', '/', $view), '/');
	      }

          
        /**
         * Get view path
         * @return string
        */
	      public function getViewPath()
	      {
	      	    return $this->view;
	      }

          
        /**
         * Set data
         * @param array $data 
         * @return void
        */
        public function setData(array $data = [])
        {
          	   $this->data = $data;
        }



        /**
         * get data
         * @param array $data 
         * @return array
        */
        public function getData()
        {
        	   return $this->data;
        }


        /**
         * Render view template
         * @param string $viewPath 
         * @param array $data 
         * @return mixed
        */  
        public function render($viewPath, $data = [])
        {
      	    $this->setData($data);
      	    $this->setViewPath($viewPath);
      	    $this->getOutPut();
        }
          

        /**
         * Get output 
         * @return void
        */
        public function getOutPut()
        {
        	   ob_start();
             extract($this->data);
             require_once $this->fullPath($this->view);
             $content = ob_get_clean();
             if($this->layout !== false)
             {
                  require_once $this->fullPath("layouts/$this->layout");

             }else{
                 
                 return '';
             }
        }
         
        
        /**
         * Get layout from config
         * @return mixed
        */
        public function configLayout()
        {
             $default = $this->app->config->get('view.layout');
             return  $default ?: false;
        }


        /**
         * Determine if the given path exist
         * @param string $path 
         * @return bool
        */
	      private function viewFileExist($path)
	      {
             return $this->file->exists($path);
	      }


	      /**
         * Get full path 
         * @param string $path
         * @return string
        */
	      private function fullPath($path)
	      {
            $basePath = sprintf($this->basePath, $path);
            $completePath = $this->file->to($basePath);
	      	  if(!$this->viewFileExist($basePath))
	      	  {
                exit(sprintf('Sorry, File <strong>%s</strong> does not exist', $completePath));
	      	  }
	      	  return $completePath;
	      }

}