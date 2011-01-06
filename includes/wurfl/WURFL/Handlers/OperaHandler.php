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
 * OperaHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_OperaHandler extends WURFL_Handlers_Handler {

    protected $prefix = "OPERA";
    const OPERA_TOLLERANCE = 5;

    /**
	 * Intercept all UAs Containing AOL and are not mobile browsers
	 *
	 * @param string $userAgent
	 * @return boolean
	 */
	public function canHandle($userAgent) {
	    if(WURFL_Handlers_Utils::isMobileBrowser($userAgent)) {
	        return false;
		}

		return WURFL_Handlers_Utils::checkIfContains($userAgent, "Opera");
	}

     /**
	 * Apply LD Match with tollerance 5
	 *
	 */
	function lookForMatchingUserAgent($userAgent) {
		return WURFL_Handlers_Utils::ldMatch(array_keys($this->userAgentsWithDeviceID), $userAgent, self::OPERA_TOLLERANCE);
	}

}