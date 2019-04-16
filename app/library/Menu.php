<?php 
namespace app\library;

use \Auth;
use \Url;

/**
 * This package very simple
 * It'll removed after
 * It's not final class
 * 
 * @package app\library\Menu
*/
class Menu 
{

        /**
         * set menu item
         * @return string
        */
        public function items() {}


        /**
         * Get menu item
         * @return string
        */
        public function getItems() {}
         

        /**
         * Generate link
         * @param string $path 
         * @param string $label 
         * @param string $class 
         * @return string
         */
        public static function link($path='', $label='', $attributes = [])
        {
        	 $attr = self::getAttributes($attributes);
             return sprintf('<a href="%s"%s>%s</a>', Url::to($path), $attr, $label) . PHP_EOL;
        }


       /**
        * Remove this method to Trait
        * Get input attributes
        * @return string
       */
  	   public static function getAttributes($attributes)
  	   {
  	   	      $output = '';
              if(!empty($attributes))
              {
              	   foreach($attributes as $name => $value)
                   {
                        $output .= sprintf(' %s="%s"', $name, $value);
                   }
                   return $output;
              }
  	   }

}

