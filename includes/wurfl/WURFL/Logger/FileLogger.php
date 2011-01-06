<?php

class WURFL_Logger_FileLogger implements WURFL_Logger_Interface  {

	const DEBUG = "DEBUG";
	const INFO = "INFO";
	
	private $fp;
	

	public function __construct($fileName) {
		if(!is_writable($fileName)) {
			throw new InvalidArgumentException("log file specified must be writable");
		}
		
		$this->fp = fopen($fileName, "a");  
	}
	
	
	
	public function log($message, $type="") {
		$time = date("F jS Y, h:iA");
		$fullMessage = "[$time] [$type] $message";
		$this->fp->puts($fullMessage);
	}
	
	public function info($message) {
		$this->log($message, self::INFO);
	}
	
	
	public function debug($message) {
		$this->log($message, self::DEBUG);
	}
	
	public function __destruct() {
		fclose($this->fp);
	}
	

}



?>