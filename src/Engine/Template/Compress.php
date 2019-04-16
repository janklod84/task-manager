<?php 
namespace JanKlod\Template;


/**
 * @package JanKlod\Template\Compress
 */
class Compress 
{
      
      private static $search =  [
            "/(\n)+/",
            "/\r\n+/",
            "/\n(\t)+/",
            "/\n(\ )+/",
            "/\>(\n)+</",
            "/\>\r\n</",
      ];
      
      private static $replace = [
            "\n",
            "\n",
            "\n",
            "\n",
            '><',
            '><',
      ];
      
      /**
       * Compress content / data 
       * For exemple it used for HTML body
       * 
       * @param string $template
       * @return string
      */
	public static function data(string $template = null)
	{
          return preg_replace(self::$search, self::$replace, $template);
	}
}