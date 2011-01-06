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
 * BotCrawlerTranscoderUserAgentHanlder
 * 
 *
 * @category   WURFL
 * @package    WURFL/UserAgentHandlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    1.0.0
 */
class WURFL_Handlers_BotCrawlerTranscoderHandler extends WURFL_Handlers_Handler {
	
	protected $prefix = "BOT_CRAWLER_TRANSCODER";
	private $botCrawlerTranscoder = array ("Bot", "Crawler", "Novarra", "Transcoder" );
	
	function __construct($normalizer) {
		parent::__construct($normalizer);
	}
	
	/**
	 * 
	 *
	 * @param string $userAgent
	 * @return boolean 
	 */
	public function canHandle($userAgent) {
		foreach ( $this->botCrawlerTranscoder as $key ) {			
			if (WURFL_Handlers_Utils::checkIfContainsCaseInsensitive($userAgent, $key )) {
				return true;
			}
		}
		return false;
	
	}
	
	

}
?>