<?php

/* Variables and functions needed only on the weave mobile page */
include_once $config['file_root'].'/includes/product-details/mobileDetails.class.php';

$l10n->load($config['file_root'].'/'.$lang.'/includes/l10n/mobile.lang');

$body_id = 'mobile-download';

$extra_headers .= <<<EXTRA_HEADERS
      <meta name="WT.ad" content="Get Firefox for Android;Get Firefox for Nokia" />
      <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/mobile-download.css" media="screen" />
      <link rel="stylesheet" href="{$config['static_prefix']}/style/tignish/video-player.css" media="screen" />
      <script src="{$config['static_prefix']}/js/mozilla-video-tools.js"></script>

      <style type="text/css">

      </style>

EXTRA_HEADERS;

$extra_footers .= <<<EXTRA_FOOTERS
<script>// <![CDATA[
  /* Whichever box is taller, make the shorter one the same height */
    $(document).ready(function(){
    h_left = $('#ffhome').height();
    h_right = $('#desktop').height();

    if(h_left >= h_right) {
        $('#desktop').height(h_left);
    }
    if (h_left < h_right) {
        $('#ffhome').height(h_right);
    }
    });
// ]]></script>


EXTRA_FOOTERS;

$links[1] = "/$lang/firefox/video/?video=fx4-mobile-whatsnew";
$links[2] = "/$lang/mobile/getinvolved/";
$links[3] = 'http://support.mozilla.com/kb/Mobile+Help+and+Tutorials';


$url           = "/$lang/m";
$android       = ___('Get Firefox for Android');
$free_android  = ___('Free from the Android Market');
$visit_android = str_replace('%s', ' href="'.$url.'"', ___('Or visit <a %s>Firefox.com/m</a> on your phone.'));
$n900          = ___('Download for <span>Nokia N900</span>');
$visit_maemo   = str_replace('%s', ' href="'.$url.'"', ___('Get Firefox for Maemo by visiting <a %s>Firefox.com/m</a> on your phone.'));
$relnotes_url  = $lang.mobileDetails::release_notes_url(mobileDetails::beta_version);
$relnotes_txt  = ___('Release Notes');
$devices       = ___('Supported Devices');
$learn         = ___('Learn More');
$itunes        = ___('Get it from iTunes - FREE');
$url_win       = mobileDetails::download_url($lang, mobileDetails::windows);
$url_mac       = mobileDetails::download_url($lang, mobileDetails::mac);
$url_lin       = mobileDetails::download_url($lang, mobileDetails::linux);

$fx_home_list  = <<<HOME
      <ul>
        <li><a href="/{$lang}/mobile/home/">{$learn}</a></li>
        <li><a href="http://itunes.com/apps/firefoxhome">{$itunes}</a></li>
      </ul>
HOME;

$fx_desktop_list  = <<<DESK
      <ul>
        <li><a href="{$url_win}" target="_blank">Windows</a></li>
        <li><a href="{$url_mac}" target="_blank">Mac OS X</a></li>
        <li><a href="{$url_lin}" target="_blank">Linux</a></li>
      </ul>
DESK;

$mobile_dl_box = <<<ANDROID
  <div id="platforms">
    <div id="platforms-divider">
        <div id="android" class="platform">
        <h3>Download for <span>Android</span></h3>
        <p class="dl">
          <a href="https://market.android.com/details?id=org.mozilla.firefox"
             onclick="dcsMultiTrack('DCS.dcssip', 'market.android.com',
                                    'DCS.dcsuri', 'details?id=org.mozilla.firefo',
                                    'WT.ti', 'Link: Get Firefox for Android',
                                    'WT.dl', 99,
                                    'WT.nv', 'Content',
                                    'WT.ac', 'Get Firefox for Android');">
            <span class="title">{$android}</span>
            <span class="desc">{$free_android}</span>
          </a>
        </p>
        <p class="notes">{$visit_android}</p>

    </div>

      <div id="nokia" class="platform">

        <h3>{$n900}</h3>
        <p>{$visit_maemo}</p>

      </div>
    </div>
  </div>
  <p class="notes"><a href="/{$relnotes_url}">{$relnotes_txt}</a> | <a href="/<?=$lang?>/mobile/platforms">{$devices}</a></p>
ANDROID;

$video = <<<VIDEO
      <script>
        // <![CDATA[
        var player_french = new Mozilla.VideoPlayer(
            'tour-video',
            [
                {
                    url:   'http://videos-cdn.mozilla.net/serv/marketing/firefox4/Mobile-launch-greatday640.webm',
                    type:  'video/webm',
                    title: 'Download in WebM format'
                },
                {
                    url:   'http://videos-cdn.mozilla.net/serv/marketing/firefox4/Mobile-launch-greatday640.theora.ogv',
                    type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                    title: 'Download in Open Video format (Ogg&nbsp;Theora)'
                },
                {
                    url:   'http://videos-cdn.mozilla.net/serv/marketing/firefox4/Mobile-launch-greatday640.mp4',
                    type:  'video/mp4',
                    title: 'Download in MPEG-4 format'
                }
            ],
            'serv/marketing/firefox4/Mobile-launch-greatday640.mp4'
        );
        // ]]>
      </script>
VIDEO;

$contentfile = $config['file_root'].'/'.$lang.'/mobile/download/content.inc.html';



// build page
require_once $headerfile;
require_once $contentfile;
require_once $footerfile;

?>
