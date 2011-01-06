<?php
/**
 * WURFL API
 *
 * LICENSE
 *
 * This file is released under the GNU General Public License. Refer to the
 * COPYING file distributed with this package.
 *
 * Copyright (c) 2008-2009, WURFL-Pro S.r.l., Rome, Italy
 * 
 *  
 *
 * @category   WURFL
 * @package    WURFL
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
abstract class  WURFL_Configuration_Config {

	const WURFL = "wurfl";
	const MAIN_FILE = "main-file";
	const PATCHES = "patches";
	const PATCH = "patch";
	const CACHE = "cache";
	const PERSISTENCE = "persistence";
	const PROVIDER = "provider";
	const PARAMS = "params";
	const LOG_DIR = "logDir";
	
	const DIR = "dir";
	
	private $configFilePath;
	private $configurationFileDir;
	
	
	function __construct($configFilePath) {
		if(!file_exists($configFilePath)) {
			throw new InvalidArgumentException("The configuration file " . $configFilePath . " does not exist.");
		}
		$this->configFilePath = $configFilePath;
		$this->configurationFileDir = dirname($this->configFilePath) . DIRECTORY_SEPARATOR;

		$this->initialize();
	}
	
	protected abstract function initialize();
	
	
	protected function getConfigFilePath() {
		return $this->configFilePath;
	}
	
	protected function getConfigurationFileDir() {
		return $this->configurationFileDir;
	}
	
	protected function fileExist($confLocation) {
		$fullFileLocation = $this->getFullPath($confLocation);
		return file_exists($fullFileLocation);
	}
		
	/**
	 * Return the full path
	 *
	 * @param string $fileName
	 * @return string
	 */
	protected function getFullPath($fileName) {
		$fileName = trim($fileName);
		if ($fileName[0] == '/') {
			return $fileName;
		}
		$fullName = $this->configurationFileDir . $fileName; 
		
		if(file_exists($fullName)) {
			return $fullName;
		}
		
		die("The File " . $fullName . " does not exist!!!\n");
	}
	
	
}
?>