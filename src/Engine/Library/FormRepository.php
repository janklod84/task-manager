<?php 
namespace JanKlod\Library;


/**
 * To be refactoring!
 * Create class HTML for manage all tags
 * 
 * @package JanKlod\Library\FormRepository 
*/
class FormRepository
{
      
      /**
       * Type fields container
       * @const array
      */
      const TYPE_FIELDS = [
          'open'     => '<form %s>', 
          'full'     => '<form %s>%s</form>',
          'label'    => '<label for="%s">%s</label>',
          'input'    => '<input type="%s"%s>',
          'select'   => '<select name="%s">%s</select>',
          'textarea' => '<textarea %s>%s</textarea>',
          'option'   => '<option value="%s">%s</option>',
          'button'   => '<button type="%s"%s>%s</button>',
          // 'surround' => '<%s>%s</%s>'
      ];


      /**
         * Get input field
         * @param string $type 
         * @param array $attributes 
         * @return string
      */
  	  public static function controlInput($type, $attributes, $label)
  	  {
  	       $html = self::checkLabel($label, $attributes);
           $html .= sprintf(self::TYPE_FIELDS['input'] . PHP_EOL, 
  	       	              $type, 
  	       	              self::getAttributes($attributes)
  	       	         );
           return $html;
  	  }


      /**
         * Get input field
         * @param string $type 
         * @param array $attributes 
         * @return string
      */
      public static function controlTextarea($attributes, $label, $value)
      {
           $html = self::checkLabel($label, $attributes);
           $html .= sprintf(self::TYPE_FIELDS['textarea'] . PHP_EOL, 
                          self::getAttributes($attributes),   
                          $value
                     );
           return $html;
      }


      /**
         * Get input field
         * @param string $type 
         * @param array $attributes 
         * @return string
      */
      public static function controlButton($attributes, $label, $type)
      {
           return sprintf(self::TYPE_FIELDS['button'] . PHP_EOL,
                          $type,
                          self::getAttributes($attributes),  
                          $label
                   );
      }


      /**
       * Get form tag 
       * @param array $attributes 
       * @return string
       */
      public static function controlForm($attributes = [])
      {
           return sprintf(self::TYPE_FIELDS['open'] . PHP_EOL,  self::getAttributes($attributes));
      }



      // /**
      //    * Surround field
      //    * @param string $data 
      //    * @return string
      // */
      // public function surround($data, $surround, $attributes = [])
      // {
      //      return sprintf(self::TYPE_FIELDS['surround'], $surround, $data, $surround);
      // }



       
       /**
        * Remove this method to Trait
        * Get input attributes
        * @return string
       */
  	   public static function getAttributes($attributes)
  	   {
  	   	      $output = '';
              if(!empty($attributes))
              {
              	   foreach($attributes as $name => $value)
                   {
                        $output .= sprintf(' %s="%s"', $name, $value);
                   }
                   return $output;
              }
  	   }

       
       /**
        * Check Label
        * @param string $label 
        * @param array $attributes 
        * @return string
      */
       private static function checkLabel($label, $attributes)
       {
           if(!empty($label))
           {
               return sprintf(self::TYPE_FIELDS['label'] . PHP_EOL, $attributes['id'] ?? '', $label);

           }else{
            
              return '';
           }

       }

}

