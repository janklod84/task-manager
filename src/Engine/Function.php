<?php 
use JanKlod\FileSystem\File;


$file = new File(__DIR__);

/**
* Load all functions of application
* @return void
*/
foreach($file->map('/Functions/*.php') as $function)
{
	 $file->call($function, false);
}
