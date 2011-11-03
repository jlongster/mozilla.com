<?php

/**
 * Extra HTML head content for the "What's New" page for Firefox 3.6.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

$transitional   = true;
$body_id        = 'whatsnew';
$_version       = getVersionBySelf();
$_valid_version = isValidVersionByReleaseNotes($_version, $config['file_root'], $lang);
$detect_flash   = true;


// check if there is a version
if($_version !== null && $_valid_version) {
    // check if we're running the latest version
    if(strcmp($_version, LATEST_FIREFOX_VERSION) == 0) {
        $latestVersion  = true;
        $oldVersion     = false;
        $unknownVersion = false;
    } else {
        $latestVersion  = false;
        $oldVersion     = true;
        $unknownVersion = false;
    }
} else {
    $latestVersion  = false;
    $oldVersion     = false;
    $unknownVersion = true;
}

$body_class     = '';
$textdir        = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';
$oop            = '';
$oop_class      = '';
$personasnumber = 180000;
$logo           = '<h2><img src="/img/firefox/3.6/firstrun/title.png" alt="Firefox 3.6" id="title-logo" /></h2>';
$logo2          = '<img src="/img/firefox/3.6/firstrun/logo.png" alt="Firefox Logo" id="title-logo" />';
$aboutlink      = 'href="/'.$lang.'/about/"';
$footerfile     = $config['file_root'].'/includes/l10n/3.6/footer-upgrade-fx4.inc.php';
$iframe         = '<iframe src="http://www.getpersonas.com/en-US/external/mozilla/firstrun.php" width="320" height="250"></iframe>';




if($oldVersion == true) {
    $extraval1 = 'block';
    $extraval2 = '';
} else {
    $extraval1 = 'none';
    $extraval2 = 'padding-top:1em;';
}


$mozilla_europe = array('bg', 'ca', 'cs', 'da', 'de', 'el', 'en-GB', 'es-ES', 'eu', 'fi', 'fr', 'hu', 'it', 'lt', 'nb-NO', 'nl', 'nn-NO', 'pl', 'pt-PT', 'ro', 'ru', 'sk', 'sq', 'sv-SE', 'sr', 'tr', 'uk');
$europe_mapping = array('en-GB' => 'en', 'es-ES' => 'es', 'nb-NO' => 'no', 'nn-NO' => 'no', 'pt-PT' => 'pt', 'sv-SE' => 'sv');

$flash1 = 'You should <a href="http://get.adobe.com/flashplayer/">update Adobe Flash Player</a> right now.';
$flash2 = 'Firefox is up to date, but your current version of Flash Player can cause security and stability issues.  Please <a href="http://get.adobe.com/flashplayer/">install the free update</a> as soon as possible.';

if ($lang != 'en-US' && ___($flash1) != $flash1 && ___($flash2) != $flash2) {
    $str1 = ___($flash1);
    $str1 = str_replace('<a href="http://get.adobe.com/flashplayer/">', '<a href="http://get.adobe.com/flashplayer/" onclick="dcsMultiTrack(\'DCS.dcssip\', \'get.adobe.com\', \'DCS.dcsuri\', \'/flashplayer/\', \'WT.ti\', \'Adobe&20-%20Adobe%20Flash%20Player\');">', $str1);
    $str1 = addslashes(___($str1));

    $str2 = ___($flash2);
    $str2 = str_replace('<a href="http://get.adobe.com/flashplayer/">', '<a href="http://get.adobe.com/flashplayer/" onclick="dcsMultiTrack(\'DCS.dcssip\', \'get.adobe.com\', \'DCS.dcsuri\', \'/flashplayer/\', \'WT.ti\', \'Adobe&20-%20Adobe%20Flash%20Player\');">', $str2);
    $str2 = addslashes(___($str2));

    $extra_footers = <<<EXTRA_FOOTERS
    <script>
    // <![CDATA[
        FlashAlertTitle = '{$str1}';
        FlashAlertText  = '{$str2}';
    // ]]>
    </script>

<script type="text/javascript" >
    // <![CDATA[

    if(gPlatform == 3 || gPlatform == 4) {
        document.getElementById('oop').style.display='none';
        document.getElementById('personalize').className='sub-feature';
    }

    // ]]>
</script>

EXTRA_FOOTERS;
}

$extra_headers = <<<EXTRA_HEADERS

    <style type="text/css">
    #whatsnew #main-feature h2 {
        margin-right:  0 !important;
    }
    </style>

EXTRA_HEADERS;


// Include the global header.  All locales will include this.
require_once "{$config['file_root']}/includes/headers/3.6/whatsnew.inc.php";
require_once "{$config['file_root']}/includes/headers/3.6/portal-pages.inc.php";

// Built dynamically in the global header now, to provide consistency across
// pages.
echo $dynamic_header;

unset($dynamic_header);

unset($dynamic_top_menu);


require_once $config['file_root'] . '/' . $lang . '/firefox/3.6/whatsnew/content.inc.html';
require_once $footerfile;

