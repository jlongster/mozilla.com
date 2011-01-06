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
class WURFL_ClassLoader {
	
	const CLASS_PREFIX = "WURFL_";
	/**
	 * Loads a Class given the class name
	 *
	 * @param string $className
	 */
	public static function loadClass($className) {		
		if($className === NULL) {
			throw new WURFL_WURFLException("Unable To Load Class : " . $className);
		}
				
		if (substr($className, 0, 6) !== WURFL_ClassLoader::CLASS_PREFIX) {
			return FALSE;
		}
		if (!class_exists($className, false)) {
			$ROOT = dirname(__FILE__) . '/../';
				
			$classFilePath = str_replace('_', '/', $className) . '.php';
			require_once ($ROOT . $classFilePath);
		}
		
		return FALSE;
	}

}

?>