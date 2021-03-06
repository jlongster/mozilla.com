<?php

/**
 * Mozilla.com prefetch script.  This will determine what server the request should
 * go to (for l10n stuff), and if we're already there, then display the file the user
 * is looking for.
 */

// Load our config
require dirname(__FILE__).'/config.inc.php';

// Load our language config
require dirname(__FILE__).'/langconfig.inc.php';

// Load the product details classes
require dirname(__FILE__).'/product-details/firefoxDetails.class.php';
require dirname(__FILE__).'/product-details/thunderbirdDetails.class.php';

// Load our migrated over functions
require dirname(__FILE__).'/functions.inc.php';

// Load the l10n class from moz-europe
require dirname(__FILE__).'/l10n_moz.class.php';

date_default_timezone_set('America/Los_Angeles');

// Start off pessimistic :)
$lang = null;

// If a ?p=... query parameter is supplied, set a partner cookie.
if (isset($_GET['p'])) {
    $partners = array(
        'foxmarks', 'ebay', 'foxytunes', 'stumbleupon', 'cooliris',
        'linkedin', 'forecastfox', 'downloadday'
    );
    if (in_array($_GET['p'], $partners)) {
        setcookie('partner', $_GET['p'], time() + ( 60*60*24*7 ), '/', '.mozilla.org');
    }
}

// (Last minute addition) The way we're choosing languages at the bottom of the
// footer now passes the language in via get - this overrides all other ways of
// choosing a language, so we're looking for it first:
if (array_key_exists('flang', $_GET) && !empty($_GET['flang'])) {
    // If it's in our language array, we've got content, we're good to go.
    if (!array_key_exists($_GET['flang'], $language_url_map)) {
        $lang = null;
    } else {
        $lang = $_GET['flang'];
    }
}

if ($lang == null) {
    // We're hoping they went to a specific host like en-us.mozilla.org.  list() will
    // give us the first chunk.
    list($lang) = explode('.',$_SERVER['SERVER_NAME']);

    // If it's in our language array, we've got content, we're good to go.
    if (!in_array($lang, array_map('strtolower', $full_languages))) {
        $lang = null;
    }
}

// Our first try didn't work, so check for the old way of specifying a language: http://mozilla.com/de/
if ($lang == null) {
    $temp = explode('/', $_SERVER['REQUEST_URI']);
    if (in_array(strtolower($temp[1]), array_map('strtolower', $full_languages))) {
        $lang = $temp[1];
    }
}

// Some of our redirects tack this stuff onto the path, which shows up in PATH_INFO
// (its-a-trap, I'm looking at you...)
if ($lang == null && array_key_exists('PATH_INFO',$_SERVER)) {
    $temp = explode('/', $_SERVER['PATH_INFO']);
    if (in_array(strtolower($temp[1]), array_map('strtolower',$full_languages))) {
        $lang = $temp[1];
    }
}

// If they didn't go to a host (they just went to mozilla.org) we'll parse their
// accept language header and try to guess where they want to go.

if (    $lang == null
     && array_key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER)
     && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])
   ) {
    $acclang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

    foreach ($acclang as $val) {
        // The value of the accept language could have a semi-colon in it (for
        // priority).  If it does, we explode, grab the first value, trim the
        // whitespace, and we've got the locale.
        $language = trim(array_shift((explode(';', $val))));

        // Check if the language is one we support
        if (in_array(strtolower($language), array_map('strtolower', $full_languages))) {

            $lang = $language;
            break; // found one

        } else {

            // If there is a dash, this will grab the short language name
            $language = array_shift((explode('-', $language)));

            if (in_array(strtolower($language), array_map('strtolower',$full_languages))) {
                $lang = $language;
                break; // found one
            } else {
                $lang = null; // (it's already null, but hey..)
            }
        }
    }
}

// If we're remapping the language to another
if (array_key_exists(strtolower($lang), $lang_remap)) {
    // Rewrite the request vars to use the language we're claiming to have detected.
    if (strtolower(substr($_SERVER['REDIRECT_URL'], 1, strlen($lang))) == strtolower($lang)) {
        $_SERVER['REDIRECT_URL'] = '/'.$lang_remap[strtolower($lang)].substr($_SERVER['REDIRECT_URL'], strlen($lang)+1);
        $_SERVER['REQUEST_URI'] = '/'.$lang_remap[strtolower($lang)].substr($_SERVER['REQUEST_URI'], strlen($lang)+1);
    }
    // we want to keep a variable with the locale code for the download boxes before remapping $lang
    $dl_lang = $lang;
    $lang    = $lang_remap[strtolower($lang)];
}

// After our detection is all said and done, we want the locale in the form xx-YY for
// file includes, etc.
if (strstr($lang,'-')) {
    list($x,$y) = explode('-', $lang);
    $lang = "{$x}-".strtoupper($y);
    unset($x,$y);
} else {
    $lang = strtolower($lang);
}

// If all our detection and guessing failed, fall back to the default
if ($lang == null || !in_array($lang, $full_languages)) {
    $lang = $config['default_lang'];
}

// A lot of the migrated scripts depend on the language being in LANG
define ('LANG', $lang);

/***   TEMPORARY CODE   ***/
/* Our time constraints have forced us to have a CheesyHack(TM) in here.  If
 * someone picks a new language from the footer, we're sending them to another
 * server (after checking if the file exists locally).  In the future we'll be
 * hosting these pages locally (and our code
 * supports that currently), but for now we have to send them to the associated
 * sites.  This temporary code will do that. (Also, it will only forward them on
 * if $_GET['flang'] is set, to prevent it from conflicting with downloads) -- clouserw
 */
 if (array_key_exists($lang, $language_url_map)
     && !file_exists("{$config['file_root']}/{$lang}{$_SERVER['REDIRECT_URL']}")
     && array_key_exists('flang', $_GET)) {
     header("Location: {$language_url_map[$lang]}");
     exit;
 }
 // If the language isn't in the map, fall through to the default (locally
 // hosted) pages.

/*** END TEMPORARY CODE ***/

// If the URL doesn't have a langauage at the front of it, we need to redirect so
// it does (otherwise we get stuff with no language at all.  For example:
//  www.mozilla.com/firefox   -->    www.mozilla.com/en-US/firefox
$url_parts = explode('/', trim($_SERVER['REDIRECT_URL'], '/'));
if ($url_parts[0] != $lang) {

    // Bug 619404 Quickly redirect homepage
    if ($_SERVER['REQUEST_URI'] == '/') {
        $_SERVER['REQUEST_URI'] = '/firefox/';
    }
    
    $parsed_url = parse_url($_SERVER['REQUEST_URI']);
    // This matches both / and /firefox because of the above code
    if (rtrim($parsed_url['path'], '/') == '/firefox') {
        $is_mobile_redirected = FALSE;
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $ua_nocase = strtolower($ua);

        // Redirect mobile devices (Android, Maemo)
        if (preg_match(':(Mobile|Maemo|Meego|Fennec|Linux armv7l):', $ua)) {
            if (isset($_GET['mobile_no_redirect']) || isset($_COOKIE['mobile_no_redirect'])) {
                setcookie('mobile_no_redirect', '1', 0, '/');
            } else {
                $_SERVER['REQUEST_URI'] = '/m/';
                $is_mobile_redirected = TRUE;
            }
        }

        // Same with iOS devices
        if (strpos($ua_nocase, 'iphone') !== FALSE &&
            strpos($ua_nocase, 'ipad') === FALSE) {

            if (isset($_GET['mobile_no_redirect']) || isset($_COOKIE['mobile_no_redirect'])) {
                setcookie('mobile_no_redirect', '1', 0, '/');
            } else {
                $_SERVER['REQUEST_URI'] = '/m/ios';
                $is_mobile_redirected = TRUE;
            }                
        }            

        if (!$is_mobile_redirected) {
            // Bug 629407 Redirect to user-specific pages
            // This is also implemented in .htaccess, but we do it here
            // to redirect the user only once
            if (preg_match('/Firefox\/(9|10|11|12)/', $ua)) {
                $_SERVER['REQUEST_URI'] = '/firefox/fx/';
            }
            else {
                $_SERVER['REQUEST_URI'] = '/firefox/new/';
            }
        }
        
        if (isset($parsed_url['query']) && $parsed_url['query'] !== '') {
            $_SERVER['REQUEST_URI'] .= '?' . $parsed_url['query'];
        }
    }
    
    header( "HTTP/1.1 301 Moved Permanently" ); 
    header("Location: {$config['url_scheme']}://{$config['server_name']}/{$lang}{$_SERVER['REQUEST_URI']}");
    header('Pragma: no-cache');
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private');
    header("Vary: User-Agent, Accept-Language");
    exit;
}

// All the firefox2 in-product pages have the language in the REDIRECT_URL.
// We're using $lang already to put it in the right directories, so we don't want
// this on there as well.  If $lang is at the front of the URL, this removes it.
if (urlHasLang($_SERVER['REDIRECT_URL'], $lang)) {
    $_SERVER['REDIRECT_URL'] = substr($_SERVER['REDIRECT_URL'], strlen($lang)+1);
}

if($_SERVER['REDIRECT_URL'] == '/mobile/android-download.html') {
    // Bug 708791
    // Allow the android download interstitial page for desktop to be 
    // viewable by all locales
    $lang = 'en-US';
}

// Special check for an index page.  This is explained in
// /includes/config.inc.php in the "directory_index" section.  Basically, if
// we're looking at a directory, check for the index page underneath
if (is_dir("{$config['file_root']}/{$lang}{$_SERVER['REDIRECT_URL']}")) {
    $_SERVER['REDIRECT_URL'] = "{$_SERVER['REDIRECT_URL']}/{$config['directory_index']}";
}

$page = "{$lang}{$_SERVER['REDIRECT_URL']}";

/* User agent redirection */
if (preg_match(':^en-US/(/)?(firefox/(/)?)?index.html$:', $page)) {
}

$firefoxDetails = new firefoxDetails();

// Check and make sure our file exists
if (file_exists("{$config['file_root']}/{$page}")) {

    // Headers and footers are included on a per-page basis.
    // This is because we need to change some variables for each page
    // for compatiblity with the CSS we have.  The per-page headers are in
    // /$lang/includes/header.inc.php

    // Setup the moz-europe code.  $l10n is used in the included files
    $l10n = new l10n_moz();

    // Parse the language file and drop info in a global variable
    $l10n->load("{$config['file_root']}/{$lang}/includes/l10n/main.lang");


    // path to the controller for localized pages
    $controller = $config['file_root'] . '/includes/l10n/controller.inc.php';

    require_once "{$config['file_root']}/{$page}";

    // We're all done.
    exit;

} else {
    // Under normal circumstances, we'd have a 404 - However, we're kind of
    // building a Frankensite with the old mozilla.com.  While we're in this
    // transitional phase, we need to check if the page they are looking for
    // exists in the default locale (en-us), and if so, we'll forward them there.
    if (file_exists("{$config['file_root']}/{$config['default_lang']}{$_SERVER['REDIRECT_URL']}")) {

        if (substr($_SERVER['REQUEST_URI'], 1, strlen($lang)) == $lang && $_SERVER['REQUEST_URI'][strlen($lang)+1] == '/') {
            $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($lang)+1);
        }

        header("Location: {$config['url_scheme']}://{$config['server_name']}/{$config['default_lang']}{$_SERVER['REQUEST_URI']}");
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private');
        exit;
    } else if (file_exists("{$config['file_root']}/{$config['default_lang']}{$_SERVER['REDIRECT_URL']}.html")) {

        if (substr($_SERVER['REQUEST_URI'], 1, strlen($lang)) == $lang && $_SERVER['REQUEST_URI'][strlen($lang)+1] == '/') {
            $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($lang)+1);
        }

        header("Location: {$config['url_scheme']}://{$config['server_name']}/{$config['default_lang']}{$_SERVER['REQUEST_URI']}.html");
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private');

    }

    // We've got a 404, show a localized 404 page
    header('Status: 404 Not Found');
    header('Pragma: no-cache');
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private');


    // Setup the moz-europe code.  $l10n is used in the included files.

    $l10n = new l10n_moz();

    // None of our locales actually have a localized 404 right now, but if
    // they do some day, it'll be easy just to drop them in there.
    if (   file_exists("{$config['file_root']}/{$lang}/404.html")
        && file_exists("{$config['file_root']}/{$lang}/includes/l10n/main.lang")) {

        // Parse the language file and drop info in a global variable
        $l10n->load("{$config['file_root']}/{$lang}/includes/l10n/main.lang");

        // Show the localized 404
        $_404 = true;
        $page = "{$lang}/404.html";
        require_once "{$config['file_root']}/{$page}";
    } else {
        // Parse the language file and drop info in a global variable
        $l10n->load("{$config['file_root']}/{$config['default_lang']}/includes/l10n/main.lang");

        // Show the default 404
        $page = "{$config['default_lang']}/404.html";
        require_once "{$config['file_root']}/{$page}";
    }
    exit;
}
?>
