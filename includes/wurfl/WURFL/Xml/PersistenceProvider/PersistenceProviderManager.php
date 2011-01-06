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
class WURFL_Xml_PersistenceProvider_PersistenceProviderManager {

    private static $_persistenceProvider;

    public static function getPersistenceProvider() {
    	
    	if (!isset(self::$_persistenceProvider)) {
    		self::_initialize();
    	}
		
    	return self::$_persistenceProvider;
    }
    
    private static function _initialize() {
    	
    	$persistenceParams = WURFL_Configuration_ConfigHolder::getWURFLConfig()->persistence;
    	$provider = $persistenceParams["provider"];
    	
    	switch ($provider) {
    		case WURFL_Constants::MEMCACHE:
    			self::$_persistenceProvider = new WURFL_Xml_PersistenceProvider_MemcachePersistenceProvider($persistenceParams);
    		break;
    		case WURFL_Constants::APC:
    			self::$_persistenceProvider = new WURFL_Xml_PersistenceProvider_APCPersistenceProvider($persistenceParams);
    			break;
    		case WURFL_Constants::MYSQL:
    			self::$_persistenceProvider = new WURFL_Xml_PersistenceProvider_MysqlPersistenceProvider($persistenceParams);
    			break;
    		default:
    			self::$_persistenceProvider = new WURFL_Xml_PersistenceProvider_FilePersistenceProvider($persistenceParams);
    			break;	
    	}	
    }
    
    
}