<?php 
namespace JanKlod\Template;


/**
 * @package JanKlod\Template\Html
*/
class HTML
{
       
        
        const FORMAT_META_DATA = '<meta name="%s" content="%s">';


        /**
         * Title of page
         * @var string 
        */
        private static $title;

        
        /**
         * Meta charset
         * @var string
        */
        private static $charset = 'UTF-8';

        
        /**
         * Meta datas
         * @var array
        */
        private static $metas = [];


        
        /**
         * set application name
         * @var string
        */
        private static $name;

        
        
        /**
         * Set title
         * @param string $title 
         * @return string
        */
        public static function setTitle($title, $default = false)
        {
              self::$title = $default ? $default .' | '. $title : $title;
        }


        /**
         * Get title
         * <title>Our Title</title>
         * @return string
        */
        public static function title()
        {
              return sprintf('<title>%s</title>', self::$title) . PHP_EOL;
        }

        
        /**
         * Set Page Language 
         * @param string $code 
         * @return string
        */
        public static function lang($code = 'en')
        {
            return sprintf('<html lang="%s">', $code) . PHP_EOL;
        }


        /**
         * Encode meta charset
         * @param type|string $encode 
         * @return type
        */
        public static function charset($encode = 'UTF-8')
        {
             return sprintf('<meta charset="%s">', $encode) . PHP_EOL;
        }

        
        /**
         * set application name
         * @param string $name 
         * @return void
        */
        public static function addName($name)
        {
             self::$name = $name;
        }


        /**
         * get application name
         * @return string
        */
        public static function appName()
        {
            return self::$name ?? '';
        }




        /**
         * Set meta data (setMeta())
         * @param type|array $metas 
         * @return type
        */
        public static function addMeta($metas)
        {
              self::$metas = $metas;
        }

        
        /**
         * Get meta datas (metas())
         * @return string
        */
        public static function renderMeta()
        {
             $meta = '';
             foreach(self::$metas as $name => $content)
             {
                 $meta .= sprintf(self::FORMAT_META_DATA, $name, $content) . PHP_EOL;
             }
             return $meta;
        }
  
}
