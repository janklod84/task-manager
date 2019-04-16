<?php 
namespace JanKlod\Helper;


/**
 * This class map result time of loading current page
 * It's used in development
 * @package JanKlod\Helper\MicroTimer 
*/ 
class MicroTimer 
{
            

	        /**
	         * Initial time when started page
	         * @var int
	        */
	        private $start;

            
            /**
             * Store all messages
             * @var array
            */
	        private $messages = [];

            
            /**
             * Style template
             * @var string
            */
	        private $style;



	        /**
	         * Constructor
	         * @param ContainerInterface $app 
	         * @return string
	        */
		    public function __construct($start)
		    {
                 $this->start    = $start;
                 $this->messages = MicroTimerStorage::DATA_MSG;
                 $this->style    = $this->getStyle(); 
		    }


		    /**
             * Add message in container message
             * @param mixed $message 
             * @return void
            */
            public function addMessage(array $messages = [])
            {
                 $this->messages = array_merge($this->messages, $messages);
            }

	        
	        /**
	         * Microtimer
	         * @param string $code [ code language we want to show messages ]
	         * @return string
	        */
		    public function show($code = 'en')
		    {
                 $html  = PHP_EOL;
                 $html .= sprintf('<div %s>%s</div>', 
                	            $this->style, 
                	            sprintf($this->messages[$code], $this->rounder())
                	         );
                 $html .= PHP_EOL;
                 echo $html;
		    }


		    /**
             * Get style
             * @return string
            */
            private function getStyle()
            {
            	 $style = '';
            	 foreach (MicroTimerStorage::DATA_STYLE as $property => $value)
            	 {
            	 	 $style .= sprintf('%s:%s;', $property, $value);
            	 }
            	 return sprintf('style="%s"', $style);
            }

            
            /**
             * Round value
             * @param int $times [How many times]
             * @return string
            */
            private function rounder($times = 5)
            {
                return round(microtime(true) - $this->start, $times);
            }
}