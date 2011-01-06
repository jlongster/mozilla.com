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

interface WURFL_Request_UserAgentNormalizer_Interface {
	
	/**
	 * Return the normalized user agent
	 *
	 * @param string $userAgent
	 */
	public function normalize($userAgent);
}

?>