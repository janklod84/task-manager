<?php 
namespace app\library;

use JanKlod\Library\Form;


/**
 * class Form with bootstrap styles
 * @package app\library\BootstrapForm
*/ 
class BootstrapForm extends Form 
{


	   // protected $surroundClass = 'form-group';
        protected $surround = 'div';


	    /**
         * Open Form tag
         * @param array $attributes 
         * @return string
        */
        public function open($attributes = [])
        {
        	 $attributes['method'] = 'POST';
        	 $attributes['autocomplete'] = 'off';
        	 $attributes['id'] = 'form';
             return parent::open($attributes);
        }
        
        /**
         * Redefinition parent method input 
         * Here we'll use bootstrap form. that is the reason
         * 
         * @param array $attributes 
         * @param string $type 
         * @return string
         */
	    public function input($attributes = [], $type='text', $label='')
	    {      
               $attributes['class'] = ($type == 'checkbox') ? '' : 'form-control';
	    	   return parent::input($attributes, $type, $label);
	    }


        /**
         * Generate input field type text
         * @param array $attributes 
         * @return string
        */
        public function text($attributes = [], $label = '')
        {
             $attributes['class'] = 'form-control';
             return parent::input($attributes, 'text', $label);
        }


        /**
         * Generate input field type text
         * @param array $attributes 
         * @return string
        */
        public function textarea($attributes = [], $label = '', $value = '')
        {
             $attributes['class'] = 'form-control';
             return parent::textarea($attributes, $label, $value);
        }

        
        /**
         * Redefinition method button form parent class Form
         * for adaptation to bootstrap form
         * 
         * @param array $attributes 
         * @param string $label 
         * @param string $type 
         * @return string
        */
	    public function button($attributes = [], $label = '', $type = 'submit')
        {
        	 $attributes['class'] = 'btn btn-primary';
             return parent::button($attributes, $label, $type);
        }


        
        /**
         * Show errors
         * @param array $errors 
         * @return string
        */
        public function showErrors($errors)
        {
              if(!empty($errors))
              {
                     echo '<ul class="alert alert-danger">';
                     foreach($errors as $error)
                     {
                         echo sprintf('<li class="">%s</li>', $error);
                     }
                     echo '</ul>';
              }
        }

}
