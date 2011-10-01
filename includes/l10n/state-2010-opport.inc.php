<?php

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';
// common content across State of Mozilla pages
require_once $config['file_root'].'/includes/l10n/state-2010-commoncontent.inc.php';

$body_id    = 'report_opportunities';
$page_title = strip_tags(___('The State of Mozilla <span>Annual Report</span>')) . ' - ' . ___('Opportunities');

$navigation = <<<NAV

{$return_top}
<ul class="nav-paging bottom">
    <li class="prev"><a href="/{$lang}/foundation/annualreport/2010/">{$l10n->get('Welcome')}</a></li>
    <li class="next"><a href="/{$lang}/foundation/annualreport/2010/people/">{$l10n->get('People')}</a></li>
</ul>

NAV;

$image1 = <<<IMAGE
        <div class="img-right">
            <img src="{$config['static_prefix']}/img/covehead/annualreport/photo-firefox-billboard.jpg" width="297" height="435" alt="{$l10n->get('Firefox billboard, San Francisco')}" />
            <p>{$l10n->get('Firefox billboard, San Francisco')}</p>
        </div>
IMAGE;

$image2 = <<<IMAGE
        <div class="img-right">
            <img src="{$config['static_prefix']}/img/covehead/annualreport/photo-celebrating-firefox.jpg" width="192" height="189" alt="Celebrating Firefox" />
            <p>{$l10n->get('Celebrating Firefox')}</p>
        </div>
IMAGE;

$image3 = <<<IMAGE
        <div class="img-right">
            <img src="{$config['static_prefix']}/img/covehead/annualreport/photo-remo-in-paris.jpg" width="294" height="261" alt="{$l10n->get('ReMo Work Week in Paris')}" />
            <p>{$l10n->get('ReMo Work Week in Paris')}</p>
        </div>
IMAGE;

$link = array(
    1  => 'http://blog.mozilla.com/privacy',
    2  => 'http://identity.mozilla.com/',
    3  => 'https://apps.mozillalabs.com/',
    4  => 'http://blog.lizardwrangler.com/2011/08/09/the-app-model-and-the-web/',
    5  => 'http://p2pu.org/webcraft',
    6  => 'http://hackasaurus.org/',
    7  => 'http://openbadges.org/',
    8  => 'http://webmademovies.org/',
    9  => 'https://drumbeat.org/journalism',
    10 => 'http://www.universalsubtitles.org',
    11 => 'http://openvideoalliance.org/',
    12 => 'http://www.bavc.org/',
    13 => 'https://webfwd.org/',
);


require_once $config['file_root'].'/includes/l10n/header-annual-report-2010.inc.php';
echo "\n<div id=\"content\">\n";
require_once $config['file_root'].'/'.$lang.'/foundation/annualreport/2010/opportunities/content.inc.html';
echo "\n</div>\n";
require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';
