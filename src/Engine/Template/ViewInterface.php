<?php 
namespace JanKlod\Template;


/**
 * @package JanKlod\Template\ViewInterface 
*/ 
class ViewInterface 
{

	    /**
		   * Render the given path with the passed variables and generate 
		   * @param string $viewPath
		   * @param array $data
		   * @return \System\View\ViewInterface
	    */
	    public function render(string $viewPath , array $data = []);
}