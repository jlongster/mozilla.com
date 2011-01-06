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
 * VodafoneUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_VodafoneHandler extends WURFL_Handlers_Handler {

	/**
	 * Intercepting All User Agents Starting with "Vodafone"
	 *
	 * @param $string $userAgent
	 * @return boolean
	 */
	function canHandle($userAgent) {
		return WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "Vodafone");
	}

	/**
	 *  If the User Agent contains the String Nokia, apply TokensMatcher strategy
	 *  using the Nokia Tokens Provider else
	 *	Apply then LD with a threshold of 3
	 *
	 * @param string $userAgent
	 * @return string
	 */
	function lookForMatchingUserAgent($userAgent) {
		$userAgents = array_keys($this->userAgentsWithDeviceID);		
		if (WURFL_Handlers_Utils::checkIfContains($userAgent, "Nokia")) {
			$tollearnce = WURFL_Handlers_Utils::indexOfOrLength($userAgent, "/", strpos($userAgent, "Nokia")); 
			return parent::applyRisWithTollerance($userAgents, $userAgent, $tollearnce);			
		}
			
		return WURFL_Handlers_Utils::ldMatch($userAgents, $userAgent, self::TOLLERANCE);
	}

	
	/**
	 * Cleans the UserAgent from the serial number
	 *
	 * @param string $userAgent
	 * @return string
	 */
	private function cleanUserAgent($userAgent) {
		$regex = "/SN\d+/";
		if(preg_match($regex, $userAgent, $matches)) {
			$string = "SN";
			for($i=2; $i< strlen($matches[0]); $i=$i+1) {
				$string .= "X";
			}
			return str_replace($matches, $string, $userAgent);
		}
		return $userAgent;
	}

	const TOLLERANCE = 3;
	protected $prefix = "VODAFONE";
}

?>