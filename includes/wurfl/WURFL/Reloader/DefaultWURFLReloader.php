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
class WURFL_Reloader_DefaultWURFLReloader implements WURFL_Reloader_Interface {
	
	public function reload($wurflConfigurationPath) {
		$wurflConfig = WURFL_Configuration_ConfigFactory::create($wurflConfigurationPath);
		WURFL_Configuration_ConfigHolder::setWURFLConfig($wurflConfig);

		$cacheProvider = WURFL_Cache_CacheProviderFactory::getCacheProvider();
		$cacheProvider->clear();
		
		$persistenceProvider = WURFL_Xml_PersistenceProvider_PersistenceProviderManager::getPersistenceProvider();
		$persistenceProvider->setWURFLLoaded(FALSE);
				
		WURFL_WURFLManagerProvider::getWURFLManager($wurflConfigurationPath);
				
		
	}
}
?>