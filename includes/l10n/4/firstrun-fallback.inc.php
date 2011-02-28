<?php

$logolink  = '/img/firefox/3.6/firstrun/logo.png';
$logo      = '<h2><img src="'.$logolink.'" alt="Firefox Logo" id="title-logo" /><span>'.$page_title.'</span></h2>';
$logo2     = '<img src="'.$logolink.'" alt="Firefox Logo" id="title-logo" />';
$aboutlink = 'href="/'.$lang.'/about/"';
$iframe    = '<iframe src="http://www.getpersonas.com/en-US/external/mozilla/firstrun.php" width="320" height="250"></iframe>';

// old 3.6 variables, avoid throwing an error
$extraval1 = $extraval2 = $oop = $oop_class = '';


$personasnumber = 240000;
if (!in_array($lang, array('as', 'bn-BD', 'bn-IN', 'en-GB', 'en-US', 'gu-IN', 'ga-IE', 'he', 'hi-IN', 'ja', 'kn', 'ml', 'mr', 'or', 'pa-IN', 'si', 'ta', 'ta-LK', 'te', 'th', 'zh-CN', 'zh-TW'))) {
    $personasnumber = number_format($personasnumber, 0, ',', '.');
} else {
    $personasnumber = number_format($personasnumber, 0, '.', ',');
}

$css = file_get_contents($config['file_root'].'/style/l10n/fx4-fistrun-fallback.css');


$extra_headers = <<<EXTRA_HEADERS

    <style>
        {$css}
    </style>
EXTRA_HEADERS;

if ($textdir == 'rtl') {
    $extra_headers .= <<<EXTRA_HEADERS
    <style>
    /* RTL support */

    </style>
EXTRA_HEADERS;
}

unset($css);

?>
