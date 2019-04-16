<?php 

return [
   
   /*
    |------------------------------------------------------------------
    |   Application starting time
    |------------------------------------------------------------------
   */
    'microtime' => microtime(true),
   
   /*
    |------------------------------------------------------------------
    |   Application Timezone
    |------------------------------------------------------------------
   */
    'timezone' => 'UTC', // Asia/Yekaterinburg

   /*
    |------------------------------------------------------------------
    |   Application Name
    |------------------------------------------------------------------
   */
    'name' => 'Задачик',


    /*
    |------------------------------------------------------------------
    |   Current language of Application
    |------------------------------------------------------------------
   */
    'language' => 'ru', // en, ru, fr


   /*
    |------------------------------------------------------------------
    |   Application Base URL 
    |   it important specify this for more security of your web site
    |------------------------------------------------------------------
   */
    'base_url' => 'http://framework.loc/',
    
   /*
    |------------------------------------------------------------------
    |  Add services alias to application
    |------------------------------------------------------------------
   */

    'alias' => [
       'Pagination' => 'app\\library\\BootstrapPagination',
       'Form'       => 'app\\library\\BootstrapForm',
       'Menu'       => 'app\\library\\Menu'
    ],
    
   /*
    |------------------------------------------------------------------
    |  Add services providers to application
    |------------------------------------------------------------------
   */
    'providers' => [
          app\providers\ValidationProvider::class,
       // app\providers\FormProvider::class,
       // app\providers\TaskProvider::class
    ]

];