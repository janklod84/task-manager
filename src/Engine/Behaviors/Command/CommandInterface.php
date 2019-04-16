<?php 
namespace JanKlod\Behavioral\Command;


/**
 * @package JanKlod\ORM\Behavioral\Command\CommandInterface
*/ 
interface Command 
{

	 /**
	  * Excecute command 
	  * @return type
	 */
	 public function execute();

     
     /**
      * Cancel [ Rollback ] command
      * @return type
     */
	 public function undo();
}