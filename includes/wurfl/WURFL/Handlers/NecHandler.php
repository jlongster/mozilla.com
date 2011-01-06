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
 * NecUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_NecHandler extends WURFL_Handlers_Handler {

	/**
	 * Intercept all UAs starting with "NEC-" and "KGT"
	 *
	 * @param string $userAgent
	 * @return boolean
	 */
	public function canHandle($userAgent) {
		return WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "NEC-")
				|| WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "KGT");
	}
	
	/**
	 * If UA starts with "NEC", apply RIS of FS
	 * If UA starts with KGT, apply LD with threshold 2
	 *
	 * @param string $userAgent
	 * @return boolean
	 */
	function lookForMatchingUserAgent($userAgent) {
		if (WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "NEC-")) {
			$tollerance = WURFL_Handlers_Utils::firstSlash($userAgent);
			return WURFL_Handlers_Utils::risMatch(array_keys($this->userAgentsWithDeviceID), $userAgent, $tollerance);
		}
		return WURFL_Handlers_Utils::ldMatch(array_keys($this->userAgentsWithDeviceID), $userAgent, self::NEC_KGT_TOLLERANCE);
	}

	const NEC_KGT_TOLLERANCE = 2;
	protected $prefix = "NEC";
}
?>