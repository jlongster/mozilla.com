<?php

// Load our config
require dirname(__FILE__).'/../config.inc.php';

// Load our language config
require $config['file_root'].'/includes/langconfig.inc.php';

// Load the l10n class
require $config['file_root'].'/includes/l10n_moz.class.php';

// common functions
require $config['file_root'].'/includes/functions.inc.php';
require $config['file_root'].'/includes/l10n/toolbox.inc.php';


if(!isset($_REQUEST['flang']) OR !in_array($_REQUEST['flang'], $full_languages)) {
    noCachingRedirect('http://www.mozilla.org/firefox/');
    exit;
}

// security measure for potential CRLF attacks
$_REQUEST['flang'] = str_replace("%0D", "", $_REQUEST['flang']);
$_REQUEST['flang'] = str_replace("%0A", "", $_REQUEST['flang']);

// sanitize the value in HTTP_REFERER to control the redirect by removing the domain, url scheme and locale
$destination = str_replace('http://',  '', $_SERVER['HTTP_REFERER']);
$destination = str_replace('https://', '', $destination);
$destination = explode('/', $destination);
$destination = array_splice($destination, 2);
$destination = implode('/', $destination);
$destination = $config['url_scheme'] . '://' . $config['server_name'] . '/' . $_REQUEST['flang'] . '/' . $destination;

permanentRedirect($destination);
exit;
