<?php

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';

$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/video-player.css" media="screen" />
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/annualreport.css" media="screen" />
    <script src="{$config['static_prefix']}/js/mozilla-video-tools.js"></script>
EXTRA_HEADERS;

l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/foundationsection.lang');


// RTL support for Mozilla.com
if ($textdir == 'rtl') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/rtl.css" media="screen" />
EXTRA_HEADERS;
}

// no italic for Chineses
if ($lang == 'zh-CN' || $lang == 'zh-TW') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/l10n/covehead/chinese-mod.css" media="screen" />
EXTRA_HEADERS;
}

// no uppercasing for Greek
if ($lang == 'el') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/l10n/covehead/greek-mod.css" media="screen" />
EXTRA_HEADERS;
}


$return_top = "\n" . '<p class="return-to-top"><a href="#">' . ___('Return to top') ."</a></p>\n";
