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
 * KDDIUserAgentHandler
 *
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_KDDIHandler extends WURFL_Handlers_Handler {

	/**
	 * Intercept all UAs starting with "KDDI"
	 *
	 * @param string $userAgent
	 * @return boolean
	 */
	public function canHandle($userAgent) {
		return WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "KDDI");
	}

	/**
	 * if UA starts with "KDDI/", apply RIS with Second Slash Otherwise apply RIS
	 * with FS
	 */
	function lookForMatchingUserAgent($userAgent) {
		if (WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "KDDI/")) {
			$tollerance = WURFL_Handlers_Utils::secondSlash($userAgent);
			return WURFL_Handlers_Utils::risMatch(array_keys($this->userAgentsWithDeviceID), $userAgent, $tollerance);
		}
		
		return parent::lookForMatchingUserAgent($userAgent);
	}


	/**
	 * Return "opwv_v62_generic"
	 *
	 * @param string $userAgent
	 * @return string
	 */
	function applyRecoveryMatch($userAgent) {
		return "opwv_v62_generic";
	}

	protected $prefix = "KDDI";
}
?>