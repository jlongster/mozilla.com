<?php

$body_id = 'report_introduction';

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';


$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/video-player.css" media="screen" />
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/annualreport.css" media="screen" />
    <script src="{$config['static_prefix']}/js/mozilla-video-tools.js"></script>
    <style>

    </style>
EXTRA_HEADERS;

if ($textdir == "rtl") {
    $extra_headers .= <<<RTL
        <style>

        </style>
RTL;
}



require_once $config['file_root'].'/includes/l10n/header-annual-report-2010.inc.php';
require_once $config['file_root'].'/'.$lang.'/foundation/annualreport/2010/content.inc.html';
require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';
