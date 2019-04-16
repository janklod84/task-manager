<?php 
namespace JanKlod\Template;


/**
 * @package JanKlod\Template\Asset
*/ 
class Asset 
{


  	     const JS_FORMAT  = '<script src="%s" type="text/javascript"></script>';
         const CSS_FORMAT = '<link rel="stylesheet" href="%s">';
         // ...

           
         /**
            * @var array container
         */
  	     public static $container = [];


         /**
          * Base Url 
          * @var string
          */
         private static $baseUrl;



         /**
          * Constructor
          * @param array $container
          * @return void
         */
         public function __construct() { }
        
         
         /**
          * Set base Url, It's for management base URL
          * @param string $baseUrl 
          * @return void
         */
         public static function addbaseUrl($baseUrl)
         {
              self::$baseUrl = $baseUrl;
         }

         
         /**
          * Get and Prepare base URL for render
          * @return string
          */
         private static function getbaseUrl()
         {
             return trim(self::$baseUrl, '/') . '/' ?? '';
         }


         /**
          * Set asset container (set())
          * @param array $container 
          * @return void
         */
         public static function set(array $container = [])
         {
              self::$container = array_merge(self::$container, $container);
         }
         

         
         /**
          * Set asset container [setParams()]
          * @param array $container 
          * @param string $baseUrl
          * @return void
         */
         public static function append(array $container = [], $baseUrl = null)
         {
       	      self::$container = array_merge(self::$container, $container);
              self::$baseUrl = $baseUrl;
         }
         
         
         /**
          * Add css 
          * @param string $link
          * @return void
         */
  	     public static function css($link = null)
  	     {
  	     	    self::$container['css'][] = sprintf(self::JS_FORMAT, trim($link, '/'));
  	     } 


	      /**
          * Add js script
          * @param string $script 
          * @return void
         */
  	     public static function js($script = null)
  	     {
  	     	   self::$container['js'][] = sprintf(self::JS_FORMAT, trim($script, '/'));
  	     }

         
         /**
          * render all js 
          * @return string
         */
  	     public static function renderJs()
  	     {
               if(!empty(self::$container['js']))
               {
                   $render = '';
               	   foreach(self::$container['js'] as $js)
                   {
                       $render .= self::render(self::JS_FORMAT, $js);
                   }

                   return $render;
               }
  	     }


	      /**
          * render all js 
          * @return string
         */
  	     public static function renderCss()
  	     {
               if(!empty(self::$container['css']))
               {
                    $render = '';
                 	  foreach(self::$container['css'] as $css)
                    {
                        $render .= self::render(self::CSS_FORMAT, $css);
                    }
                    return $render;
               }
  	     }

         
         /**
          * render output
          * @param string $mask 
          * @param string $path 
          * @return string
         */
         private static function render($mask, $path)
         {
              return sprintf($mask . PHP_EOL, self::getbaseUrl(). trim($path, '/'));
         }
}