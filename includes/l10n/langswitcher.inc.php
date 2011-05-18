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
    noCachingRedirect('http://www.mozilla.com/');
    exit;
}


$_REQUEST['flang'] = str_replace("%0D", "", $_REQUEST['flang']); // security measure for potential CRLF attacks
$_REQUEST['flang'] = str_replace("%0A", "", $_REQUEST['flang']); // security measure for potential CRLF attacks

permanentRedirect($config['url_scheme'].'://'.$config['server_name'].'/'.$_REQUEST['flang'].'/m/');
exit;
