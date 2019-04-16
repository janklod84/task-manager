<?php
namespace JanKlod\Library;


use JanKlod\Http\Request;


/**
 * To Refactoring
 * 
 * @package JanKlod\Library\Pagination 
*/
class Pagination
{
    
            /**
             * Current page
             * @var int
            */
            public $currentPage;

            /**
             * Numbers of pages 
             * @var int 
            */
            public $perpage;

            /**
             * @var total pages
            */
            public $total;

            /**
             * @var count of pages
            */
            public $countPages;

            
            /**
             * class link
             * @var string
            */
            protected $classLink = 'default-class-link';


            /**
             * Back Link
             * @var string
            */
            protected  $back; 

            /**
             * Next Link
             *@var string
            */
            protected  $forward; 

            /**
             * Start page
             * @var string
            */
            protected  $startpage; 

            /**
             * End page
             * @var 
            */
            protected  $endpage; 

            /**
             * Second left page
             * @var string
            */
            protected  $page2left;

            /**
             * First left page
             * @var string
            */
            protected  $page1left; 

            /**
             * Second right page
             * @var string
            */
            protected  $page2right; 


            /**
             * @var First right page
            */
            protected  $page1right;



            /**
             * request params
             * @var string
            */
            public $uri;



            /**
             * Constructor
             * @param type $page 
             * @param int $perpage 
             * @param int $total 
             * @param string $classLink 
             * @return void
            */
            public function __construct($page = '', $perpage = '', $total = null, $classLink = '')
            {
                    $this->perpage = $perpage;
                    $this->total = $total;
                    $this->countPages = $this->getCountPages();
                    $this->currentPage = $this->getCurrentPage($page);
                    $this->uri = (new Request())->uri();
                    $this->classLink = $classLink;
            }
            
            /**
             * Print out pagination template
             * @return string
            */
            public function __toString()
            {
                 return $this->getHtml();
            }
            
            /**
             * Get html output
             * This method abolutly be REFACTORING! Don't worry)
             * I'll do very pretty print
             * 
             * @return string
            */
            public function getHtml()
            {
                if( $this->currentPage > 1 )
                {
                    $this->back = "<li><a class='nav-link' href='page=" .($this->currentPage - 1). "'>&lt;</a></li>";
                }

                if( $this->currentPage < $this->countPages )
                {
                    $this->forward = "<li><a class='nav-link' href='page=" .($this->currentPage + 1). "'>&gt;</a></li>";
                }

                if( $this->currentPage > 3 )
                {
                    $this->startpage = "<li><a class='nav-link' href='page=1'>&laquo;</a></li>";
                }

                if( $this->currentPage < ($this->countPages - 2) )
                {
                    $this->endpage = "<li><a class='nav-link' href='page={$this->countPages}'>&raquo;</a></li>";
                }

                if( $this->currentPage - 2 > 0 )
                {
                    $this->page2left = "<li><a class='nav-link' href='page=" .($this->currentPage-2). "'>" .($this->currentPage - 2). "</a></li>";
                }

                if( $this->currentPage - 1 > 0 )
                {
                    $this->page1left = "<li><a class='nav-link' href='page=" .($this->currentPage-1). "'>" .($this->currentPage-1). "</a></li>";
                }

                if( $this->currentPage + 1 <= $this->countPages )
                {
                    $this->page1right = "<li><a class='nav-link' href='page=" .($this->currentPage + 1). "'>" .($this->currentPage+1). "</a></li>";
                }

                if( $this->currentPage + 2 <= $this->countPages )
                {
                    $this->page2right = "<li><a class='nav-link' href='page=" .($this->currentPage + 2). "'>" .($this->currentPage + 2). "</a></li>";
                }

                return '<ul class="pagination">' . $this->startpage.$this->back.$this->page2left.$this->page1left.'<li class="active"><a>'.$this->currentPage.'</a></li>'.$this->page1right.$this->page2right.$this->forward.$this->endpage . '</ul>';
            }
            
            /**
             * Get count of page
             * @return int
            */
            public function getCountPages(): int
            {
                 return ceil($this->total / $this->perpage) ?: 1;
            }
            
            /**
             * Get current page
             * @param int $page 
             * @return type
            */
            public function getCurrentPage(int $page)
            {
                if(!$page || $page < 1) $page = 1;
                if($page > $this->countPages) $page = $this->countPages;
                return $page;
            }
            
            /**
             * Get start page
             * @return int
            */
            public function getStart()
            {
                return ($this->currentPage - 1) * $this->perpage;
            }
}