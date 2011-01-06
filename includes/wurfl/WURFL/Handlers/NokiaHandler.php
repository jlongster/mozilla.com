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
 * NokiaUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_NokiaHandler extends WURFL_Handlers_Handler  {

	
	protected $prefix = "NOKIA";
	
	
	/**
	 * Intercepting All User Agents containing "Nokia"
	 *
	 * @param string $userAgent
	 * @return boolean
	 */
	function canHandle($userAgent) {
		return WURFL_Handlers_Utils::checkIfContains($userAgent, "Nokia");
	}


	/**
	 *
	 * Apply RIS with FS (First Slash) after Nokia String as a threshold.
	 * 
	 * 
	 * @param string $userAgent
	 * @return string
	 */
	function lookForMatchingUserAgent($userAgent) {
		$tollerance = WURFL_Handlers_Utils::indexOfOrLength($userAgent, "/", strpos($userAgent, "Nokia"));		
		$userAgents = array_keys($this->userAgentsWithDeviceID);
		return parent::applyRisWithTollerance($userAgents, $userAgent, $tollerance);
				
	}
	
	
	/**
	 * If the User Agent contains "Series60" and "Series80". 
	 * Return "nokia_generic_series60" and "nokia_generic_series80" 
	 * respectively in case of success.
	 *
	 * @param string $userAgent
	 * @return string
	 */
	function applyRecoveryMatch($userAgent) {
		if(!(strpos($userAgent, "Nokia") === false)) {
			if (strpos($userAgent, "Series60") != 0) {
				return "nokia_generic_series60";
			}
			if (strpos($userAgent, "Series80") != 0) {
				return "nokia_generic_series80";
			}
		}

		return WURFL_Constants::GENERIC;
	}

	
}
?>