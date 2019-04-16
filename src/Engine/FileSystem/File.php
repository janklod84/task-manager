<?php 
namespace JanKlod\FileSystem;


/**
 * @package File
**/
class File
{
        
       
       /**
        * Directory Separator
        * @const string
       */
       const DS = DIRECTORY_SEPARATOR;


       /**
        * @var string
       */
       private $root;
       
     
       /**
        * File constructor.
        * @param string $root
        * @return void
        * @ // throws FileException
       */
       public function __construct($root)
       {
            if(is_null($root))
            {
                exit('set please route directory!');
            }

            $this->root = trim($root, '/');
       }

       
       /**
        * set root directory
        * @param string $root 
        * @return void
       */
       public function setRoot($root)
       {
            $this->root = $root;
            return $this;
       }


       /**
        * Remove only root 
        * @return void
       */
       public function remove()
       {
            $this->root = null;
       }


       /**
        * Determine wether the given file path exists
        * 
        * Ex: (new File(__YOUR__ROOT__))->exists('routes/app.php');
        * 
        * @param string $file
        * @return bool
       */
       public function exists($file): bool
       {
            if(!is_null($this->root))
            {
                return file_exists($this->to($file));

            }else{
               
               return file_exists($file);
            }
       }

       
       /**
        * Require  The given file
        *
        * Ex: (new File(__YOUR__ROOT__))->call('storage/cache')
        * 
        * @param string $file
        * @param bool $root [depend if you want active base root or not]
        * @return void
       */
        public function call($file, $root = true)
        {
            if($root === false)
            {
                return require_once($file);
            }
            return require_once($this->to($file));
        }

        
        /**
         * Require many files
         * 
         * Ex: (new File(__YOUR__ROOT__))->calls([
         *   /path/to/a-file.php,
         *   /path/to/b-file.php,
         *   /path/to/c-file.php,
         *   /path/to/d-file.php, ...
         * ]);
         * 
         * @param array $files 
         * @return bool
         */
        public function calls($files = [])
        {
              foreach($files as $file)
              {
                  return require_once($file);
              }
        }

        

        /**
         * Generate full path to the given path
         *
         * Ex: (new File(__YOUR__ROOT__))->to('path/to/folder/test.php')
         * 
         * @param string $path
         * @return string
        */
        public function to($path)
        {
             return $this->root . $this->preparePath($path);
        }

    
       /**
        * Get path details informations
        * 
        * Ex: (new File(__YOUR__ROOT__))->details('/path/to/v-form.php')
        * 
        * @param string $path 
        * @return string
       */
       public function details($path)
       {
             return pathinfo($path);
       }

       
       /**
        * Scan file and return alls path type
        * 
        * Ex: (new File(__YOUR__ROOT__))->map('/path/to/file/type/*.php')
        * 
        * 
        * @param string $path 
        * @return array
       */
       public function map($path)
       {   
            if(!is_null($path) && !empty($this->root))
            {
                return glob($this->to($path));

            }elseif(empty($this->root)){

                return glob($path);

            }else{

               return [];
            }
  
       }

       
       /**
        * Prepare path 
        * @param string $path 
        * @return string
       */
       private function preparePath($path)
       {
            return self::DS. str_replace(['/', '\\'], static::DS, trim($path, '/'));
       }
}

