<?php

class l10n_moz
{

	function __construct() {
		$GLOBALS['__l10n_moz'] = array();
		$GLOBALS['__l10n_moz_files'] = array();
	}

    /**
     *
     */
    function get($key) {
        if (array_key_exists($key, $GLOBALS['__l10n_moz']) && !empty($GLOBALS['__l10n_moz'][$key])) {
            return $GLOBALS['__l10n_moz'][$key];
        } else {
            return $key;
        }
    }
	
    /**
     * Reads in a file of strings into a global array.  File format is:
        ;String in english
        translated string

        ;Another string
        another translated string

     */
	function load($file)
	{
		if (!file_exists($file)) {
			trigger_error('l10n file not found',E_USER_NOTICE);
			return false;
		}
		
		$f = file($file);
		

		$GLOBALS['__l10n_moz_files'][] = $file;
		for ($i=0; $i<count($f); $i++) {
			if (substr($f[$i],0,1) == ';' && !empty($f[$i+1])) {
				$GLOBALS['__l10n_moz'][trim(substr($f[$i],1))] = trim($f[$i+1]);
				$i++;
			}
		}
	}
}

?>
