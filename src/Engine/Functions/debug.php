<?php 

if(!function_exists('debug'))
{     
	  /**
	   * Function for working with array data
	   * print out datas
	   * @param array $arr 
	   * @param bool $die 
	   * @return mixed
	   */
	  function debug($arr, $die = false)
      {
		  echo '<pre>';
		  print_r($arr);
		  echo '</pre>';
		  if($die) die;
      }
}

