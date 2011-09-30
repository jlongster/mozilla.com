<?php

$body_id = 'report_introduction';

// commodity functions for localized pages
l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/foundationsection.lang');
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

$navigation = <<<NAV
<ul class="nav-paging bottom">
    <li class="next"><a href="/{$lang}/foundation/annualreport/2010/opportunities/">{$l10n->get('Opportunities')}</a></li>
</ul>
NAV;

require_once $config['file_root'].'/includes/l10n/header-annual-report-2010.inc.php';
require_once $config['file_root'].'/'.$lang.'/foundation/annualreport/2010/content.inc.html';
require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';
