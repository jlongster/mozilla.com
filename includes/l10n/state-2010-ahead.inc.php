<?php

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';
// common content across State of Mozilla pages
require_once $config['file_root'].'/includes/l10n/state-2010-commoncontent.inc.php';

$body_id    = 'report_ahead';
$page_title = strip_tags(___('The State of Mozilla <span>Annual Report</span>')) . ' - ' . ___('Ahead');

$navigation = <<<NAV

{$return_top}

<ul class="nav-paging bottom">
    <li class="prev"><a href="/{$lang}/foundation/annualreport/2010/people/">{$l10n->get('People')}</a></li>
    <li class="next"><a href="/{$lang}/foundation/annualreport/2010/faq/">{$l10n->get('FAQ')}</a></li>
</ul>

NAV;

$video_placeholder = <<<VIDEO

<div id="video">

    <div id="video-player" class="mozilla-video-control">
        <a href="http://videos-cdn.mozilla.net/brand/Mozilla_Firefox_Manifesto_v0.2_640.webm" id="video-ahead"><img width="400" height="225" src="{$config['static_prefix']}/img/covehead/annualreport/poster-ahead.jpg" alt="Video: {$l10n->get('Looking Ahead <span>Mitchell Baker</span>')}" /></a>
    </div>

    <div id="video-description">
        <h3>{$l10n->get('Looking Ahead <span>Mitchell Baker</span>')}</h3>
        <p>{$l10n->get('Mitchell Baker, Chair discusses the state of Mozilla.')}</p>

<!--
        <ul class="share">
            <li><a href="" class="button">{$l10n->get('Share')}</a></li>
            <li><a href="" class="button">{$l10n->get('Embed')}</a></li>
        </ul>
-->


        <p class="download">{$l10n->get('Download this video:')}</p>
        <ul class="download">
            <li><a href="">{$l10n->get('WebM format')}</a></li>
            <li><a href="">{$l10n->get('Ogg Theora format')}</a></li>
            <li><a href="">{$l10n->get('MPEG-4 format')}</a></li>
        </ul>
    </div>
</div>

VIDEO;

require_once $config['file_root'].'/includes/l10n/header-annual-report-2010.inc.php';
echo $video_placeholder;
echo "\n<div id=\"content\">\n";
require_once $config['file_root'].'/'.$lang.'/foundation/annualreport/2010/ahead/content.inc.html';
echo "\n</div>\n";

?>
<script>
// <![CDATA[
var player_sync = new Mozilla.VideoPlayer(
    'video-ahead',
    [
        {
            url:   'http://videos-cdn.mozilla.net/brand/Mozilla_Firefox_Manifesto_v0.2_640.webm',
            type:  'video/webm; codecs=&quot;vp8, vorbis&quot;',
            title: '<?=___('WebM format')?>'
        },
        {
            url:   'http://videos-cdn.mozilla.net/brand/Mozilla_Firefox_Manifesto_v0.2_640.theora.ogv',
            type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
            title: '<?=___('Ogg Theora format')?>'
        },
        {
            url:   'http://videos-cdn.mozilla.net/brand/Mozilla_Firefox_Manifesto_v0.2_640.mp4',
            type:  'video/mp4',
            title: '<?=___('MPEG-4 format')?>'
        }
    ],
    'serv/webmademovies/Moz_Doc_0329_GetInvolved_ST.mp4'
);
// ]]>
</script>
<?php
require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';
