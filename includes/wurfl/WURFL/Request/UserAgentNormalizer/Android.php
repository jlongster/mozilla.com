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


class WURFL_Request_UserAgentNormalizer_Android implements WURFL_Request_UserAgentNormalizer_Interface  {
	
	
	/**
	 * Return the Android String with the version 
	 * 
	 * 
	 * @param string $userAgent
	 * @return string
	 */
	public function normalize($userAgent) {		
		return $this->androidWithMajorAndMinorVersion($userAgent);				
	}
	
	
	private function androidWithMajorAndMinorVersion($userAgent) {
		return substr($userAgent, strpos($userAgent, "Android"), 11);
	}
	
	

}


?>