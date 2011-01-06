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
 * ChromeUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_ChromeHandler extends WURFL_Handlers_Handler {

	
	protected $prefix = "CHROME";

	
	function __construct($userAgentNormalizer) {
		parent::__construct($userAgentNormalizer);
	}
	
	

	/**
	 * Intercept all UAs Containing Chrome and are not mobile browsers
	 *
	 * @param string $userAgent
	 * @return boolean
	 */
	public function canHandle($userAgent) {
		if(WURFL_Handlers_Utils::isMobileBrowser($userAgent)) {
			return false;
		}
		return WURFL_Handlers_Utils::checkIfContains($userAgent, "Chrome");
	}
	

}