<?php 
namespace JanKlod\Library;


/**
 * @package JanKlod\Library\Form 
*/
class Form 
{


        /**
         * Data from anywhere [Request., Database ..]
         * @var array
        */
        protected $data = [];

    

        /**
         * Errors containers
         * @var array
        */
        protected $errors = [];

        
        /**
         * Surround inputs fields with html tag
         * @var string
        */
        protected $surround = ''; // div


        
        /**
         * Constructor
         * @param array $data 
         * @return void
         */
        public function __construct($data = [])
        {
               $this->data = $data;
        }

       
        /**
         * Set data parses form
         * @param array $data 
         * @return void
        */
        public function set(array $data = [])
        {
              $this->data = $data;
        }


        /**
         * get data from form
         * @return data
        */
        public function get()
        {
            return $this->data;
        }

        
        /**
         * get value from data
         * @param type $name 
         * @return type
        */
        public function value($name)
        {
            return $this->data[$name] ?? '';
        }

        
        /**
         * Set errors
         * @param array $errors
         * @return void
        */
        public function setErrors($errors)
        {
             $this->errors = $errors;
        }
        
        
        /**
         * Open Form tag
         * @param array $attributes 
         * @return string
        */
        public function open($attributes = [])
        {
             return FormRepository::controlForm($attributes);
        }


        /**
         * close Form tag
        */
        public function close()
        {
            return '</form>'.PHP_EOL;
        }

        
        /**
         * Surround field
         * @param string $data 
         * @return string
        */
        public function surround($data, $attributes = [])
        {
             if($this->surround)
             {
                 $attr = FormRepository::getAttributes($attributes);
                 $html = sprintf("<{$this->surround} %s>", $attr). PHP_EOL;
                 $html .= $data;
                 $html .= "</{$this->surround}>". PHP_EOL;

             }else{

                 return $data;
             }
        }

        
        /**
         * Generate any input field
         * $form->input([
         *    'placeholder' => "Enter your login",
         *    'id' => 'password'
         * ], 'password', 'Login'); 
         * Fixe with method surround  $this->surround($data)
         * 
         * @param string $type 
         * @param array $attributes 
         * @return string
        */
        public function input($attributes = [], $type = 'text', $label = '')
        {
             return FormRepository::controlInput($type, $attributes, $label);
        }

        
        /**
         * Generate field type hidden
         * @param array $attributes 
         * @return string
        */
        public function hidden($attributes = [])
        {
             return FormRepository::controlInput('hidden', $attributes, false);
        }


        /**
         * Generate input field type text
         * @param array $attributes 
         * @return string
        */
        public function text($attributes = [], $label = '')
        {
             return FormRepository::controlInput('text', $attributes, $label);
        }

        
        /**
         * Get input type file
         * @param array $attributes 
         * @return string
        */
        public function file($attributes, $label = '')
        {
             return FormRepository::controlInput('file', $attributes, $label);
        }


        /**
         * Generate input field type text
         * @param array $attributes 
         * @return string
        */
        public function textarea($attributes = [], $label = '', $value = '')
        {
             return FormRepository::controlTextarea($attributes, $label, $value);
        }
       
        
        /**
         * Generate button field
         * @param array $attributes 
         * @param string $label 
         * @param string $type 
         * @return string
        */
        public function button($attributes = [], $label = '', $type = 'button')
        {
             return FormRepository::controlButton($attributes, $label, $type);
        }


         /**
         * Generate field type checkbox
         * To Refactoring this method
         * @param array $attributes 
         * @param string $label 
         * @return status
        */
        public function checkBox($attributes = [], $label = '', $checked = 0)
        {
               ($checked == 1) ? $attributes['checked'] = 'checked' : '';
               return FormRepository::controlInput('checkbox', $attributes, $label);
        }

}

