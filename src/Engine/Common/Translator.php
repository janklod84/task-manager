<?php 
namespace JanKlod\Common;


/**
 * @package JanKlod\Common\Translator 
**/ 
class Translator
{
        
        
        /**
         * @var array
        */
        private static $translation = [];

        
        /**
         * Constructor
         * @param array $translation 
         * @return void
        */
        public function __construct($translation) {}


	     /**
           * Translate Message
           * @param array $translation 
           * @return void
         */
         public static function addTranslation($translation = [])
         {
               self::$translation = $translation;
         }


         /**
          * Get translation Message
          * @param array $handler 
          * @return string
         */
         public static function getTranslate($handler)
         {
               return str_replace(
               	    array_keys(self::$translation), 
               	    array_values(self::$translation), 
               	    $handler
               );
         }
}