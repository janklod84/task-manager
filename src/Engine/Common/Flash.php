<?php 
namespace JanKlod\Common;


/**
 * @package JanKlod\Common\Flash
 */
class Flash 
{
        

        /**
         * @var array 
        */
        private static $messages;


        /**
         * @var session key
        */ 
        private static $sessionKey = 'session.flash';

        
        
        /**
         * Set message for show user
         * @param string $key 
         * @param string $message 
         * @return string
         */
        public static function message($key = '', $message = '')
        {
              Session::put($key, $message);
        }

        /**
         * Obtain data from session
         * @param string $key 
         * @return mixed
        */
        public static function check($key)
        {
             return Session::check($key);
        }

        
        /**
         * Get Flash output to HTML format
         * It's momentaly resolver it's will great after
         * 
         * @param type $key 
         * @param type|string $class 
         * @return type
         */
        public static function show($key, $class = 'flash-default', $surround='div')
        {
            if(Session::has($key))
            {
                $html  = sprintf('<%s class="%s">', $surround, $class);
                $html .= self::check($key);
                $html .= sprintf('</%s>', $surround);
                Session::remove($key);
                return $html;
            }
        }
        
        /**
         * Set success flash
         * 
         * @param string $message 
         * @return void
         */
        public static function success(string $message)
        {
             $flash = Session::check(self::$sessionKey, []);
             $flash['success'] = $message;
             Session::put(self::$sessionKey, $flash);  
        }
        

        /**
         * Set errors flash
         * @param string $message 
         * @return void
         */
        public static function error($message)
        {
             $flash = Session::check(self::$sessionKey, []);
             $flash['error'] = $message;
             Session::put(self::$sessionKey, $flash);
        }

       
        /**
         * Get type message
         * @param string $type 
         * @return mixed
        */
        public static function get(string $type): ?string
        {
              if(is_null(self::$messages))
              {
                   self::$messages = Session::check(self::$sessionKey, []);
                   Session::delete(self::$sessionKey);

              }
             
              if(array_key_exists($type, self::$messages))
              {
                  return self::$messages[$type];
              }

             return null;
         }

         
         /**
          * Determine if has key in session
          * @param string $key 
          * @return bool
          */
         public static function has($key): bool
         {
             return array_key_exists($key, Session::check(self::$sessionKey));
         }

         
         /**
          * Determine if has key session.flash in Session
          * @return bool
         */
         public static function ensuredExist(): bool
         {
             return Session::has('session.flash');
         }


         /**
          * Get all Message in container
          * @return null|array
         */
         public static function all()
         {
              return self::$message ?? [];
         }
      
}