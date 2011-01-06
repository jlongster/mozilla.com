<?php

class WURFL_Logger_LoggerFactory {
	
	public static function createUndetectedDeviceLogger() {	
		if(self::isLoggingConfigured()) {
			return self::createFileLogger("undetected_devices.log");
		}
		return new WURFL_Logger_NullLogger ( );
	}
	
	public static function create() {
		if(self::isLoggingConfigured()) {
			return self::createFileLogger("wurfl.log");
		}
		return new WURFL_Logger_NullLogger ( );				
	}
	

	private static function createFileLogger($fileName) {
		$wurflConfig = WURFL_Configuration_ConfigHolder::getWURFLConfig();
		$logFileName = self::createLogFile ( $wurflConfig->logDir, $fileName );
		return new WURFL_Logger_FileLogger ( $logFileName );
	
	}
	
	private static function isLoggingConfigured() {	
		$wurflConfig = WURFL_Configuration_ConfigHolder::getWURFLConfig ();
		$logDir = $wurflConfig->logDir;
		return isset ( $wurflConfig->logDir ) && is_writable ( $logDir );
	}
	
		
	private static function createLogFile($logDir, $fileName) {		
		return $logDir . File . DIRECTORY_SEPARATOR . $fileName;
	}

}

?>