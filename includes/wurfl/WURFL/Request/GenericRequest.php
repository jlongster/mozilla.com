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
class WURFL_Request_GenericRequest {
	
	function __construct($userAgent, $userAgentProfile, $xhtmlDevice){
		$this->userAgent = $userAgent;
		$this->userAgentProfile = $userAgentProfile;
		$this->xhtmlDevice = $xhtmlDevice;
		$this->id = md5($this->userAgent);
	}
	
	function __get($name){
		return $this->$name;
	}
	
	private $userAgent;
	private $userAgentProfile;
	private $xhtmlDevice;
	private $id;
}

?>