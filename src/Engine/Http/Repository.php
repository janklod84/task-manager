<?php 
namespace JanKlod\Http;


use JanKlod\Collections\Collection;

/**
 * This class is factory repository all superglobals data
 * @package JanKlod\Http\Repository 
*/ 
class Repository
{
        
        /**
         * @var 
        */
        private static $data = [];


        
        /**
         * Find data by allowed key
         * @param type|null $key 
         * @return Collection
        */
        public static function storage($key = null): Collection
        {
               switch($key)
               {
               	    case 'get':
               	      self::$data = $_GET;
               	    break;

               	    case 'post':
               	      self::$data = $_POST;
               	    break;

                    case 'request':
                      self::$data = $_REQUEST;
                    break;

                    case 'file':
                      self::$data = $_FILES;
                    break;

                    case 'cookie':
                      self::$data = $_COOKIE;
                    break;

                    case 'server':
                      self::$data = $_SERVER;
                    break;

                    default:
                      throw new \Exception(sprintf('Sorry, key <strong>%s</strong> not match!', $key));
               }

               return new Collection(self::$data);
        }
}