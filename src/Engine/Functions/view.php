<?php 





if(!function_exists('partials'))
{

   /**
    * Includes partials views like 'sidebar, widget, menu ..etc'
    * @param string $path 
    * @return void
    */
     function partials($path = '')
     {
        if(defined('ROOT'))
        {
              $file = sprintf('%s/app/views/%s.php', ROOT, trim($path, '/'));

              if(!file_exists($file))
              {
                  exit(sprintf('File <strong>%s</strong> doesn\'t exist', $file));

              }
              return require_once(realpath($file));
          
        }else{

            return require_once('/app/views/'. $path);
        }
       
     }
}



if(!function_exists('view_path'))
{
     /**
      * Show full view path for user
      * @param string $path 
      * @return string
      */
     function view_path($path = '', $style = 'margin: 10px 0 10px 5px')
     {
        echo sprintf('<div style="%s"><small>Current view path : </small><code>%s</code></div>', $style, $path);
     }
}



if(!function_exists('error'))
{
      
      /**
       * Load view path
       * @param string $code
       * @return void
      */
      function error($code = 404)
      {
          require_once ROOT . 'public/' . mb_strtolower($code) . '.phtml';
      }
}