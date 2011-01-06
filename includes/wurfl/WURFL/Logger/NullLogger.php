<?php

class WURFL_Logger_NullLogger implements WURFL_Logger_Interface  {
	
	function log($message) {
	}
	
	function debug($message) {		
	}
	
	function info($message){}
}

?>