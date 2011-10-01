<?php

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';
// common content across State of Mozilla pages
require_once $config['file_root'].'/includes/l10n/state-2010-commoncontent.inc.php';

$body_id    = 'report_people';
$page_title = strip_tags(___('The State of Mozilla <span>Annual Report</span>')) . ' - ' . ___('People');

$navigation = <<<NAV
<ul class="nav-paging bottom">
    <li class="prev"><a href="/{$lang}/foundation/annualreport/2010/opportunities/">{$l10n->get('Opportunities')}</a></li>
    <li class="next"><a href="/{$lang}/foundation/annualreport/2010/ahead/">{$l10n->get('Ahead')}</a></li>
</ul>

NAV;

$video_placeholder = <<<VIDEO
    <div id="video-player" class="mozilla-video-control">
        <a href="http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.webm" id="video-getinvolved"><img width="400" height="225" src="{$config['static_prefix']}/img/covehead/annualreport/poster-getinvolved.jpg" alt="Video: {$l10n->get('Getting Involved')}" /></a>
    </div>
    <div id="video-description">
        <h3>{$l10n->get('Getting Involved')} <span class="time">2:58</span></h3>
        <p>{$l10n->get('Mozilla is a fun, diverse community of people from around the world.')}</p>

        <p>{$l10n->get('Download this video:')}</p>
        <ul class="download">
            <li><a href="http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.webm">{$l10n->get('WebM format')}</a></li>
            <li><a href="http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.ogv">{$l10n->get('Ogg Theora format')}</a></li>
            <li><a href="http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.mp4">{$l10n->get('MPEG-4 format')}</a></li>
        </ul>
    </div>

VIDEO;

require_once $config['file_root'].'/includes/l10n/header-annual-report-2010.inc.php';
require_once $config['file_root'].'/'.$lang.'/foundation/annualreport/2010/people/content.inc.html';
require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';


