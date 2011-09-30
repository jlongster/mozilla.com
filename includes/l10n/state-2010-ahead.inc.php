<?php

$body_id = 'report_ahead';

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';
// common content across State of Mozilla pages
require_once $config['file_root'].'/includes/l10n/state-2010-commoncontent.inc.php';

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
        <video id="video" width="400" height="225" controls="controls">
            <source src="http://videos-cdn.mozilla.net/brand/Mozilla_Firefox_Manifesto_v0.2_640.webm" type="vide/webm" />
            <source src="http://videos-cdn.mozilla.net/brand/Mozilla_Firefox_Manifesto_v0.2_640.theora.ogv" type="video/ogg; codecs=&quot;theora, vorbis&quot;" />
            <source src="http://videos-cdn.mozilla.net/brand/Mozilla_Firefox_Manifesto_v0.2_640.mp4" type="video/mp4" />
            <object type="application/x-shockwave-flash" style="width: 290px; height: 191px;" data="/includes/flash/playerWithControls.swf?flv=brand/Mozilla_Firefox_Manifesto_v0.2_640.mp4&amp;autoplay=false&amp;msg=Play%20Video">
                <param name="movie" value="/includes/flash/playerWithControls.swf?flv=brand/Mozilla_Firefox_Manifesto_v0.2_640.mp4&amp;autoplay=false&amp;msg=Play%20Video" />
                <param name="wmode" value="transparent" />
                <div class="video-player-no-flash">

                {$l10n->get('This video requires a browser with support for open video:')}
                <ul>
                <li>{$l10n->get('<a href="http://www.mozilla.org/firefox/">Firefox</a> 3.5 or greater')}</li>
                <li>{$l10n->get('<a href="http://www.apple.com/safari/">Safari</a> 3.1 or greater')}</li>
                </ul>
                {$l10n->get('or the <a href="http://www.adobe.com/go/getflashplayer">Adobe Flash Player</a>')}.
                {$l10n->get('Alternatively, you may use the video download links to the right.')}
                </div>
            </object>
        </video>
    </div>
    <div id="video-description">
        <h3>{$l10n->get('Lookin Ahead <span>Mitchell Baker</span>')}</h3>
        <p>{$l10n->get('Mitchell Baker, Chair discusses The state of Mozilla.')}</p>
        <ul class="share">
            <li><a href="" class="button">{$l10n->get('Share')}</a></li>
            <li><a href="" class="button">{$l10n->get('Embed')}</a></li>
        </ul>
        <p>{$l10n->get('Download this video:')}</p>
        <ul class="download">
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
require_once $config['file_root'].'/includes/l10n/footer-annual-report-2010.inc.php';
