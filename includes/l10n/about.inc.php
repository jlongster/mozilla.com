<?php

$body_id = 'firefox-about';

/*
    Page specific CSS
*/

$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/about.css" media="screen" />
EXTRA_HEADERS;

/*
    locales style mods for the page
*/

$extra_headers .= <<<EXTRA_HEADERS
    <style>
    #wrapper {
        background: url("{$config['static_prefix']}/img/covehead/firefox/survey/thanks-background.png") no-repeat scroll 1100px 150px transparent;
    }

    #main-feature, #content {
        margin-right: 400px;
        font-size: 16px;
    }

    </style>
EXTRA_HEADERS;

/*
    RTL Support
*/

if ($textdir == 'rtl') {
    $extra_headers .= <<<RTL
    <style>
        
    body.rtl #wrapper {
        background: url("{$config['static_prefix']}/img/covehead/firefox/survey/thanks-background-rtl.png") no-repeat scroll 200px 150px transparent !important;
    }


    body.rtl #content,
    body.rtl #main-feature {
        margin-left: 400px !important;
        margin-right: 20px !important;
    }

    </style>
RTL;
}


/*
    build the page
*/

require_once $config['file_root'] . '/includes/l10n/header-pages.inc.php';
$translation = $config['file_root'] . '/' . $lang . '/about/content.inc.html';
require_once $config['file_root'] . '/includes/l10n/footer-pages.inc.php';

