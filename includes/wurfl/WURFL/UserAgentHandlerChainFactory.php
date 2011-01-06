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

class WURFL_UserAgentHandlerChainFactory {
	
	static private $_userAgentHandlerChain = NULL;
	
	private function __construct() {}
	
	/**
     * Factory
     *
     * @return WURFL_UserAgentHandlerChain
     */
    public static function create() {    	
    	self::init();
    	return self::$_userAgentHandlerChain;
    }
	
    static private function init() {
    	
    	
    	self::$_userAgentHandlerChain = new WURFL_UserAgentHandlerChain();
    	
    	
    	$normalizer = new WURFL_Request_UserAgentNormalizer_Null();
 
    	$chromeNormalizer = new WURFL_Request_UserAgentNormalizer_Chrome();
    	$operaNormalizer = new WURFL_Request_UserAgentNormalizer_Opera();
    	$safariNormalizer = new WURFL_Request_UserAgentNormalizer_Safari();
    	$firefoxNormalizer = new WURFL_Request_UserAgentNormalizer_Firefox();
    	$msieNormalizer = new WURFL_Request_UserAgentNormalizer_MSIE();
    	
    	self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_VodafoneHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_NokiaHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_SonyEricssonHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_MotorolaHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_BlackBerryHandler($normalizer));

		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_SiemensHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_SagemHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_SamsungHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_PanasonicHandler($normalizer));

		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_NecHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_QtekHandler($normalizer));

		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_MitsubishiHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_PhilipsHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_LGHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_AppleHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_KyoceraHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_AlcatelHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_SharpHandler($normalizer));
			
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_SanyoHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_BenQHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_PantechHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_ToshibaHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_GrundigHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_HTCHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_SPVHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_WindowsCEHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_PortalmmmHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_DoCoMoHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_KDDIHandler($normalizer));
		
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_AndroidHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_OperaMiniHandler($normalizer));
		
		// Web Browsers handlers
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_BotCrawlerTranscoderHandler($normalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_ChromeHandler($chromeNormalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_OperaHandler($operaNormalizer));
        self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_SafariHandler($safariNormalizer));
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_FirefoxHandler($firefoxNormalizer));
        
        self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_MSIEHandler($msieNormalizer));


        
		self::$_userAgentHandlerChain->addUserAgentHandler(new WURFL_Handlers_CatchAllHandler($normalizer));
		
    	
    }
    
   
}

?>