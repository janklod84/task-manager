<?php 
namespace JanKlod;


/**
 * This class contain some configurations of Application
 * @package JanKlod\Definition 
*/
class Definition 
{
       

           /**
             * Name of Application
             * @const string
            */
            const APP_NAME = 'JanKlod';


    	   /**
             * Minimum Version PHP Required
            */
            const APP_VERSION = [
            	'php' => '7.1', // 7.2.11
            	'app' => '0.1'
            ];

            
            /**
             * Message handler register
            */
            const APP_MSG = [
                'php_version' => 'This application use php version minimum <strong>%s</strong> but your version is <strong>%s</strong>'
            ];


            /** 
             * @const array 
            */
      			const AVALAIBLE_CONFIG = [
      			         'app',
                     'asset',
                     'database',
                     'cookie', 
                     'hash', 
                     'session', 
                     'view', 
                     'pagination'
      			];


			
            /**
             * Container Services Providers
             * @const array
            */
            const APP_SERVICES = [
                  'providers' => [
                        \JanKlod\Collections\Facades\CollectionProvider::class,
                        \JanKlod\Configuration\Facades\ConfigProvider::class,
                        \JanKlod\Http\Facades\RequestProvider::class,
                        \JanKlod\Routing\Facades\RouterProvider::class, 
                        \JanKlod\Http\Facades\ResponseProvider::class,
                        \JanKlod\Template\Facades\ViewProvider::class,
                        \JanKlod\Database\Facades\DatabaseProvider::class,
                        \JanKlod\Loading\Facades\LoaderProvider::class,
                        \JanKlod\Validation\Facades\ValidationProvider::class,
                  ],
                  'alias' => [
                     'Route'    => 'JanKlod\\Routing\\Route',
                     'Asset'    => 'JanKlod\\Template\\Asset',
                     'HTML'     => 'JanKlod\\Template\\HTML', 
                     'Session'  => 'JanKlod\\Common\\Session',
                     'Token'    => 'JanKlod\\Encryption\\Token',
                     'Validate' => 'JanKlod\\Validation\\Validate',
                     'Auth'     => 'JanKlod\\Authentication\\Auth',
                     'Config'   => 'JanKlod\\Configuration\\Config',
                     'Url'      => 'JanKlod\\Common\\Url',
                     'Flash'    => 'JanKlod\\Common\\Flash',
                     'Router'   => 'JanKlod\\Routing\\Router'
                  ]
            ];
        
}