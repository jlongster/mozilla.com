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
 * AndroidUserAgentHanlder
 * 
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_AndroidHandler extends WURFL_Handlers_Handler {
	
	protected $prefix = "ANDROID";
	
	
	/**
	 * Intercept all UAs containing "Android"
	 *
	 * @param string $userAgent
	 * @return boolean 
	 */
	public function canHandle($userAgent) {
		return WURFL_Handlers_Utils::checkIfContains($userAgent, "Android");
	}

	/**
	 * Use RIS with first space after the Android String as tollerance
	 *
	 * @param string $userAgent
	 */
	function lookForMatchingUserAgent($userAgent) {
		$tollerance = WURFL_Handlers_Utils::indexOfOrLength($userAgent, " ", strpos($userAgent, "Android"));		
		$userAgents = array_keys($this->userAgentsWithDeviceID);
		return parent::applyRisWithTollerance($userAgents, $userAgent, $tollerance);		
	}
	
	
	/**
	 * If the User Agent contains "Android" 
	 * Return "generic_andorid" 
	 * 
	 * @param string $userAgent
	 * @return string
	 */
	function applyRecoveryMatch($userAgent) {
		return "generic_android";
	}
	
	
	
}
?>