<?php 
namespace JanKlod;


/**
 * Can run this autoloader if you don't use Composer
 * @package JanKlod\Autoloader    
*/ 
class Autoloader 
{
       

        const DS = DIRECTORY_SEPARATOR;

        /**
         * Instance of Autoloader
         * @var Autoloader
        */
        private static $instance;
        
        
        /**
         * data
         * @var array
        */
        private $data;


        /**
         * root
         * @var string
        */
        private $root;


        
        /**
         * container all config params autoloader
         * @var array
         */
        private $params = [];


        
        /**
         * Get instance Autoloader
         * @param string $file
         * @return self
        */
        public static function instance($params = []): self
        {
              if(is_null(self::$instance))
              {
              	  self::$instance = new self($params);
              }

              return self::$instance;
        }


        
        /**
         * Constructor
         * @param array $params
         * @return void
        */
        private function __construct($params = [])
        {
             $this->params = $this->checkParams($params);

             // get all data from file
             $this->data = $this->getData($params['json']); 
             
             // root directory 
             $this->root = $params['base_path'];
             
             // autoloader register
             $this->register();
        }


        /**
         * verify if good params and check them
         * @param array $params 
         * @return void
        */
        private function checkParams($params)
        {
             if(!empty($params))
             { 
                     if(empty($params['json']))
                     {
                          exit(sprintf('Sorry, not found file for autoloading'));
                     }

                     if(empty($params['base_path']))
                     {
                          exit(sprintf('Empty base path .'));
                     }
             }
             
        }
        
        
        /**
         * register classes
         * @return void
        */
        private function register()
        {
        	 spl_autoload_register([$this, 'load']);
        }


        
        /**
         * Load classes
         * @param type $class 
         * @return type
        */
        private function load($class)
        {
            if(!empty($this->data['autoload']))
            {
                 $file = null;
                 foreach($this->data['autoload'] as $ns => $path) 
                 {
                       $file = $this->getFile($ns, $this->preparePath($path), $class);
                    
                       if($this->existFile($file))
                       {
                            require_once($file);
                            return true;
                       }
                 }

                return false; 
            }
        }

        
        
        /**
         * Prepare full path to require
         * @param string $ns 
         * @param string $path 
         * @param string $class 
         * @return string
         */
        private function getFile($ns, $path, $class)
        {
             return sprintf('%s%s%s.php', 
                $this->root,  
                self::DS,  
                str_replace([$ns , '\\'], [$path, self::DS], $class)  
             );
        }

        
        /**
         * Prepare path
         * @param string $path 
         * @return string
        */
        private function preparePath($path)
        {
             return str_replace('/', self::DS, trim($path, '/')) . self::DS;
        }


        /**
         * Get data from json
         * @param string $path 
         * @return mixed
         */
        private function getData($path)
        {
            if($this->existFile($path))
            {
                 if(pathinfo($path, PATHINFO_EXTENSION) === 'json')
                 { 
                       return json_decode(file_get_contents($path), true);
            
                 }else {
                       
                       exit(sprintf('This File <strong>%s</strong> isn\'t json format', $path));
                 }

            }else{

                exit(sprintf('File <strong>%s</strong> doesn\'t exist', $path));
            }
           
        }
      

        /**
         * Determine if file exist
         * @param string $file 
         * @return bool
         */
        private function existFile($file): bool
        {
            return file_exists($file);
        }
}

