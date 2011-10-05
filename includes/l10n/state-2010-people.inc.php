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

        <p class="download">{$l10n->get('Download this video:')}</p>
        <ul class="download">
            <li><a href="http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.webm">{$l10n->get('WebM format')}</a></li>
            <li><a href="http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.ogv">{$l10n->get('Ogg Theora format')}</a></li>
            <li><a href="http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.mp4">{$l10n->get('MPEG-4 format')}</a></li>
            <li><a href="http://www.universalsubtitles.org/en/videos/VPRyx1WZwY6Z/">{$l10n->get('Other languages & sharing')}</a></li>
        </ul>
    </div>

VIDEO;

$image1 = <<<IMAGE
        <div class="img-center">
            <img src="{$config['static_prefix']}/img/covehead/annualreport/photo-mozilla-meetup-brazil.jpg" width="660" height="365" alt="{$l10n->get('Mozilla Meetup, Brazil')}" />
            <p>{$l10n->get('Mozilla Meetup, Brazil')}</p>
        </div>
IMAGE;

$image2 = <<<IMAGE
        <div class="img-right">
            <img src="{$config['static_prefix']}/img/covehead/annualreport/photo-arabic-mozilla.jpg" width="425" height="275" alt="{$l10n->get('Arabic Mozilla')}" />
            <p>{$l10n->get('Arabic Mozilla')}</p>
        </div>
IMAGE;

$image3 = <<<IMAGE
        <div class="img-left">
            <img src="{$config['static_prefix']}/img/covehead/annualreport/photo-mozilla-kenya.jpg" width="294" height="198" alt="{$l10n->get('Mozilla Kenya')}" />
            <p>{$l10n->get('Mozilla Kenya')}</p>
        </div>
IMAGE;

$image4 = <<<IMAGE
        <div class="img-right">
            <img src="{$config['static_prefix']}/img/covehead/annualreport/photo-mozilla-indonesia.jpg" width="187" height="249" alt="{$l10n->get('Mozilla Indonesia')}" />
            <p>{$l10n->get('Mozilla Indonesia')}</p>
        </div>
IMAGE;

$image5 = <<<IMAGE
        <img src="{$config['static_prefix']}/img/covehead/annualreport/kumi.png" width="134" height="104" style="margin-left: 150px" alt="Kumi" />
IMAGE;

$image6 = <<<IMAGE
        <div class="img-left">
            <img src="{$config['static_prefix']}/img/covehead/annualreport/photo-mozilla-paris.jpg" width="294" height="278" alt="{$l10n->get('ReMo Work Week in Paris')}" />
            <p>{$l10n->get('ReMo Work Week, Paris')}</p>
        </div>
IMAGE;

$link = array(
    1  => 'http://www.arabicmozilla.org/',
    2  => 'http://pierros.papadeas.gr/?p=253',
    3  => 'http://mozilla-ghana.org',
    4  => 'http://www.mozilla-kenya.org/',
    5  => 'http://www.mozilla-kenya.org/blog/18-road-trip',
    6  => 'http://www.mozilla-hispano.org',
    7  => 'http://www.mozilla.org/contribute/local/',
    8  => 'http://www.mozilla.web.id/',
    9  => 'https://wiki.mozilla.org/Drumbeat/MoJo',
    10 => 'http://www.mozilla.org/contribute/',
);


require_once $config['file_root'].'/includes/l10n/header-annual-report-2010.inc.php';
require_once $config['file_root'].'/'.$lang.'/foundation/annualreport/2010/people/content.inc.html';
?>

<script>
// <![CDATA[
var player_sync = new Mozilla.VideoPlayer(
    'video-getinvolved',
    [
        {
            url:   'http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.webm',
            type:  'video/webm; codecs=&quot;vp8, vorbis&quot;',
            title: '<?=___('WebM format')?>'
        },
        {
            url:   'http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.ogv',
            type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
            title: '<?=___('Ogg Theora format')?>'
        },
        {
            url:   'http://videos-cdn.mozilla.net/serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.mp4',
            type:  'video/mp4',
            title: '<?=___('MPEG-4 format')?>'
        }
    ],
    'serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.mp4',
    true,
    '<a href="http://www.universalsubtitles.org/en/videos/VPRyx1WZwY6Z/" class="lang-link"><?=$l10n->get('Other languages & sharing')?></a>'
);
// ]]>
</script>

<?php

require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';


