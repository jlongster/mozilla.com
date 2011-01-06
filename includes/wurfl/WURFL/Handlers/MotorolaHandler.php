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

/**
 * MotorolaUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_MotorolaHandler extends WURFL_Handlers_Handler {
	
	/**
	 * Intercept all User Agents 
	 * starting with "MOT-", "Mot-" or "Motorola"
	 *
	 * @param string $userAgent
	 * @return boolean
	 */
	public function canHandle($userAgent) {
		return WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "MOT-")
		|| WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "Mot-")
		|| WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "Motorola");
		
	}
	
	/**
	 * If the User Agent contains "MIB/2.2" or "MIB/BER2.2", 
	 * return "mot_mib22_generic"
	 *
	 * @param string $userAgent
	 * @return string
	 */
	function applyRecoveryMatch($userAgent) {
		if (WURFL_Handlers_Utils::checkIfContains($userAgent, "MIB/2.2")
			|| WURFL_Handlers_Utils::checkIfContains($userAgent, "MIB/BER2.2")) {
			return "mot_mib22_generic";
		}

		return WURFL_Constants::GENERIC;
	}
	
	protected $prefix = "MOTOROLA";
}
?>