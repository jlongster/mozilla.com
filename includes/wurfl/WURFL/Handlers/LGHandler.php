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
 * LGUserAgentHandler
 *
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_LGHandler extends WURFL_Handlers_Handler {

	/**
	 * Intercept all UAs starting with "LG"
	 *
	 * @param string $userAgent
	 * @return string
	 */
	public function canHandle($userAgent) {
		return WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "LG") 
		|| WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "lg");
	}

	/**
	 * If UA starts with either "LG/" or "LGE/"
	 * apply RIS with SS (second slash)
	 * For everything else apply RIS with FS
	 *
	 * @param string $userAgent
	 * @return string
	 */
	function lookForMatchingUserAgent($userAgent) {
		if (WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "LG/")
		|| WURFL_Handlers_Utils::checkIfStartsWith($userAgent, "LGE/")) {
			$tollerance = WURFL_Handlers_Utils::secondSlash($userAgent);
		} else {
			$tollerance = WURFL_Handlers_Utils::firstSlash($userAgent);
		}
		
		return WURFL_Handlers_Utils::risMatch(array_keys($this->userAgentsWithDeviceID), $userAgent, $tollerance);
	}

	protected $prefix = "LG";
}
?>