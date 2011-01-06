<?php

/*
 * creates a json version of our main.lang file
 *
 * usage: mainlang_to_json.php?lang=zh-CN
 *
 */


// Load our config
require dirname(__FILE__).'/../config.inc.php';

// Load our language config
require $config['file_root'].'/includes/langconfig.inc.php';

// Load the l10n class from moz-europe
require $config['file_root'].'/includes//l10n_moz.class.php';

$lang = (isset($_GET['lang'])) ? strip_tags(addslashes($_GET['lang'])) : false;

if ($lang == false || !in_array($lang, $full_languages)) {
    exit;
}

$file = $config['file_root'].'/'.$lang.'/includes/l10n/main.lang';

$l10n = new l10n_moz();

if (file_exists($file)) {

    $l10n->load($file);

    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');
    echo json_encode($GLOBALS['__l10n_moz']);
}

exit;




?>
