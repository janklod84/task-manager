<?php 
namespace JanKlod\Validation;


use JanKlod\Database\ActiveRecord;


/**
 * @package JanKlod\Validation\Validate
*/
class Validate
{
	
		 /**
		  * @var bool
		 */
		 private $passed = false;
		 
	     
	     /**
	      * @var array errors
	     */
		 private $errors = [];

		 
		 /**
		  * @var 
		 */
		 private $connect;


         
         /**
          * @var array
         */
		 private $translation = [];

	     
		 /**
		  * Constructor 
		  * @param \JanKlod\Database\DatabaseManager
		  * @return void
		 */
		 public function __construct($db)
		 {
		 	    $this->connect = new ActiveRecord($db);
		 }

	     
	     /**
	      * Check source and items
	      * @param string $source 
	      * @param array $items 
	      * @return mixed
	     */
		 public function check($source, $items = [])
		 {
		 	  foreach($items as $item => $rules)
		 	  {
		 	  	  foreach($rules as $rule => $rule_value)
		 	  	  {
		 	  	  	    $value = trim($source[$item]);
		 	  	  	    $item  = escape($item);

		 	  	  	    if($rule === 'required' && empty($value))
		 	  	  	    {
	                          $this->addError("{$item} is required");

		 	  	  	    }else if(!empty($value)){

	                         switch($rule)
	                         {
	                         	  case 'min':
	                                 if(strlen($value) < $rule_value)
	                                 {
	                                    $this->addError("{$item} must be a minimum of {$rule_value} characters.");
	                                 }
	                         	  break;
	                         	  case 'max':
	                         	     if(strlen($value) > $rule_value)
	                                 {
	                                    $this->addError("{$item} must be a maximum of {$rule_value} characters.");
	                                 }

	                         	  break;
	                         	  case 'matches':
	                         	     if($value != $source[$rule_value])
	                         	     {
	                         	     	  $this->addError("{$rule_value} must match {$item}");
	                         	     }

	                         	  break;
	                         	  case 'unique':
	                                $check = $this->connect->find($rule_value, $item, $value);
	                                // debug($check, true);
                                    if($check)
                                    {
                                  	    $this->addError("{$item} already exists.");
                                    }
	                         	    break;
	                         }
		 	  	  	    }
		 	  	  }
		 	  }


		 	  if(empty($this->errors))
		 	  {
		 	  	   $this->passed = true;
		 	  }

		 	  return $this;
	     
	     }

         
         
         /**
          * Get errors
          * @return type
         */
		 public function errors()
		 {
		 	  return $this->errors;
		 }

         
         /**
          * return true or false if no errors
          * @return bool
         */
		 public function passed(): bool
		 {
		 	  return $this->passed;
		 }

         
         /**
          * Translate Message
          * @param array $translation 
          * @return void
         */
         public function addTranslation($translation = [])
         {
               $this->translation = $translation;
         }


         /**
          * Get translation Message
          * @param array $handler
          * @return string
         */
         public function getTranslate($handler)
         {
               return str_replace(
               	    array_keys($this->translation), 
               	    array_values($this->translation), 
               	    $handler
               );
         }


         /**
          * Add error
          * @param string $error 
          * @return void
         */
		 private function addError($error)
		 {
	          $this->errors[] = $this->getTranslate($error);
		 }

}