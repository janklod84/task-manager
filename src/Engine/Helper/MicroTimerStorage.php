<?php 
namespace JanKlod\Helper;


/**
 * @package JanKlod\Helper\MicroTimerStorage
*/ 
class MicroTimerStorage
{

        /**
         * @const array
        */
  	    const DATA_MSG = [
             'en' => 'Page generated in <b>%s</b> seconds',
  	         'fr' => 'Page generee en <b>%s</b> secondes',
  	         'ru' => 'Страница сгенирована в <b>%s</b> секунд'
  	    ];

        
        /**
         * @const array 
        */
        const DATA_STYLE = [
           'position'     => 'fixed',
           'bottom'       =>  0,
           'background'   => '#900', // #007BFF
           'color'        => '#fff',
           'line-height'  => '30px',
           'height'       => '30px',
           'left'         => 0,
           'right'        => 0,
           'padding-left' => '10px',
           'z-index'      => 9999,
           'font-family'  => 'Arial'
        ];
}