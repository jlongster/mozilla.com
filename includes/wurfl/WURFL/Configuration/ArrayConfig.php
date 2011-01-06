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
class WURFL_Configuration_ArrayConfig extends  WURFL_Configuration_Config {
	
	private $wurflFile;
	
	private $logDir;
	
	private $wurflPatches = array();
	
	private $persistence = array();
	
	private $cache = array();
	
	function __construct($configFilePath) {
		parent::__construct($configFilePath);
		
	}
	
	protected function initialize() {
		include parent::getConfigFilePath();		
		$configurationArrayDefined = isset($configuration);
		if(!$configurationArrayDefined) {
			throw new Exception("configuration array must be defined in the configuraiton file");
		}
		
		$this->init ($configuration);
	}
	
	
	function __get($name) {
		return $this->$name;
	}
	
	
	
	
	private function init($configuration) {
		
		if (array_key_exists ( WURFL_Configuration_Config::WURFL, $configuration )) {
			$this->setWurflConfiguration($configuration[WURFL_Configuration_Config::WURFL]);
		}
		
		if (array_key_exists ( WURFL_Configuration_Config::PERSISTENCE, $configuration )) {
			$this->setPersistenceConfiguration ( $configuration [WURFL_Configuration_Config::PERSISTENCE] );
		}
		
		if (array_key_exists ( WURFL_Configuration_Config::CACHE, $configuration )) {
			$this->setCacheConfiguration ( $configuration [WURFL_Configuration_Config::CACHE] );
		}
		
		if (array_key_exists ( WURFL_Configuration_Config::LOG_DIR, $configuration )) {
			$this->setLogDirConfiguration($configuration[WURFL_Configuration_Config::LOG_DIR]);
		}
	}
	
	
	private function setWurflConfiguration(array $wurflConfig) {
		
		if (array_key_exists ( WURFL_Configuration_Config::MAIN_FILE, $wurflConfig )) {
			$this->wurflFile = parent::getFullPath($wurflConfig [WURFL_Configuration_Config::MAIN_FILE]);
		}
		
		if(array_key_exists(WURFL_Configuration_Config::PATCHES, $wurflConfig)) {
			foreach ($wurflConfig[WURFL_Configuration_Config::PATCHES] as $wurflPatch) {
				$this->wurflPatches[] = parent::getFullPath($wurflPatch);
			}				 
		}		
	}

	private function setPersistenceConfiguration(array $persistenceConfig) {
		$this->persistence = $persistenceConfig;
	}

	private function setCacheConfiguration(array $cacheConfig) {
		$this->cache = $cacheConfig;
	}
	
	
	private function setLogDirConfiguration($logDir) {
		if(!is_writable($logDir)) {
			throw new InvalidArgumentException("log dir $logDir  must exist and be writable");
		}
		
		$this->logDir = $logDir;
	}
	
	
	
}

?>