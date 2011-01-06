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
 * SonyEricssonUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_SonyEricssonHandler extends WURFL_Handlers_Handler {

	protected $prefix = "SONY_ERICSSON";
	
	/**
	 * Intercept all UAs containing "SonyEricsson"
	 *
	 * @param string $userAgent
	 * @return boolean
	 */
	public function canHandle($userAgent) {
		return WURFL_Handlers_Utils::checkIfContains($userAgent, "SonyEricsson");
	}

	/**
	 * If UA starts with "SonyEricsson", apply RIS with FS as a threshold.
	 * If UA contains "SonyEricsson" somewhere in the middle,
	 * apply RIS with threshold second slash
	 *
	 * @param string $userAgent
	 * @return string
	 */
	function lookForMatchingUserAgent($userAgent) {
		if (WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "SonyEricsson")) {
			$tollerance = WURFL_Handlers_Utils::firstSlash($userAgent);
			return WURFL_Handlers_Utils::risMatch(array_keys($this->userAgentsWithDeviceID), $userAgent, $tollerance);
		}
		$tollerance = WURFL_Handlers_Utils::secondSlash($userAgent);
		return WURFL_Handlers_Utils::ldMatch(array_keys($this->userAgentsWithDeviceID), $userAgent, $tollerance);

	}
	
	
	
}
?>