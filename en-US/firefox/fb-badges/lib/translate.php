<?php

/*
 *  Translate
 *  A small translation lib
 *  Usage: 
 *
 */

class Translate {
    /* The current locale */
	public static $locale = "en_US";
	/* A cache of translated strings */
	public static $strings = NULL;
	/* An array of acceptable locales (Currently not in use) */
	public static $locales = array("en_US");
	
	/* Set the locale for translation */
	public static function set_locale($locale = "") {
	   /* TODO: Check if it is a locale we have, so we don't need to do the file exists check */
		if($locale) {
		  self::$locale = $locale;
		}
	}
	
	/* Translate a string to the set locale */
	public static function str($str) {
        if(is_null(self::$strings)) {        		
            if(file_exists("../locales/" . self::$locale . ".json")) {
            	$json = file_get_contents("locales/" . self::$locale . ".json");
            	self::$strings = json_decode($json, true);
            } else {
            	$json = file_get_contents("locales/en_US.json");
            	self::$strings = json_decode($json, true);
            }
        }
        
        return (isset(self::$strings[$str])) ? self::$strings[$str] : $str;
	}
}

?>