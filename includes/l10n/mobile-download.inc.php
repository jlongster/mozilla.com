<?php

/* Variables and functions needed only on the weave mobile page */
include_once $config['file_root'].'/includes/product-details/mobileDetails.class.php';

$l10n->load($config['file_root'].'/'.$lang.'/includes/l10n/mobile.lang');

$body_id = 'mobile-download';

$extra_headers .= <<<EXTRA_HEADERS
      <meta name="WT.ad" content="Get Firefox for Android;Get Firefox for Nokia" />
      <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/mobile-download.css" media="screen" />
      <link rel="stylesheet" href="{$config['static_prefix']}/style/tignish/video-player.css" media="screen" />
      <script src="{$config['static_prefix']}/js/jquery/jquery.min.js"></script>
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

$link[1] = "/$lang/firefox/video/?video=fx4-mobile-whatsnew";
$link[2] = "/$lang/mobile/getinvolved/";
$link[3] = 'http://support.mozilla.com/kb/Mobile+Help+and+Tutorials';

$url               = "/$lang/m";
$android           = ___('Get Firefox for Android');
$free_android      = ___('Free from the Android Market');
$visit_android     = str_replace('%s', ' href="'.$url.'"', ___('Or visit <a %s>Firefox.com/m</a> on your phone.'));
$android2          = ___('Download for <span>Android</span>');
$androidBeta       = ___('Download Beta for Android');
$n900              = ___('Download for <span>Nokia N900</span>');
$visit_maemo       = str_replace('%s', ' href="'.$url.'"', ___('Get Firefox for Maemo by visiting <a %s>Firefox.com/m</a> on your phone.'));
$relnotes_url      = $lang.mobileDetails::release_notes_url(mobileDetails::latest_version);
$relnotes_url_beta = $lang.mobileDetails::release_notes_url(mobileDetails::beta_version);
$relnotes_txt      = ___('Release Notes');
$devices           = ___('Supported Devices');
$learn             = ___('Learn More');
$itunes            = ___('Get it from iTunes - FREE');
$url_win           = mobileDetails::download_url($lang, mobileDetails::windows);
$url_mac           = mobileDetails::download_url($lang, mobileDetails::mac);
$url_lin           = mobileDetails::download_url($lang, mobileDetails::linux);

$android_beta_links = <<<BLOCK
      <a class="download" href="https://market.android.com/details?id=org.mozilla.firefox_beta">{$androidBeta} »</a>

      <p class="notes">{$free_android}</p>
      <div class="download-other"><a href="/{$lang}/{$relnotes_url_beta}">{$relnotes_txt}</a></div>
BLOCK;

$fx_home_list  = <<<HOME
      <ul>
        <li><a href="/{$lang}/mobile/home/">{$learn}</a></li>
        <li><a href="http://itunes.com/apps/firefoxhome">{$itunes}</a></li>
      </ul>
HOME;

$fx_desktop_list  = <<<DESK

  <ul id="desktop_download">
    <li id="desktop_windows"><a href="{$url_win}" target="_blank" class="download">{$l10n->get('Download')}<span> Windows</span></a></li>
    <li id="desktop_mac"><a href="{$url_mac}" target="_blank" class="download">{$l10n->get('Download')}<span> Mac OS X</span></a></li>
    <li id="desktop_linux"><a href="{$url_lin}" target="_blank" class="download">{$l10n->get('Download')}<span> Linux</span></a></li>
  </ul>

    <span class="for">{$l10n->get('for')}</span>

  <select id="desktop_choser">
    <option value="windows">Windows</option>
    <option value="mac">Mac OS X</option>
    <option value="linux">Linux</option>
  </select>

DESK;

$body = <<<BODY
<div id="main-feature">
    <h2>{$l10n->get('Download Firefox to <span>Your Mobile</span>')}</h2>
</div>

<div id="main-content">
  <div id="platforms">
    <div id="platforms-divider">
        <div id="android" class="platform">
        <h3>{$android2}</h3>
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
            <div class="download-other"><a href="/{$relnotes_url}">{$relnotes_txt}</a></div>
        </p>
        <p><a href="/{$lang}/mobile/platforms">{$devices}</a></p>
        <p class="notes">{$visit_maemo}</p>

    </div>

    <div id="iphone" class="platform">
        <h3>{$l10n->get('Firefox Home for <span>iPhone</span>')}</h3>
        <p class="dl">
            <a href="http://itunes.com/apps/firefoxhome"
             onclick="dcsMultiTrack('DCS.dcssip', 'itunes.com',
                                    'DCS.dcsuri', 'apps/firefoxhome',
                                    'WT.ti', 'Link: Get Firefox Home for iPhone',
                                    'WT.dl', 99,
                                    'WT.nv', 'Content',
                                    'WT.ac', 'Get Firefox Home for iPhone');">
            <span class="title">{$l10n->get('Get Firefox Home for iPhone')}</span>
            <span class="desc">{$l10n->get('Free from iTunes')}</span>
            </a>
        </p>

        <p>{$l10n->get('Access your Firefox history, bookmarks and open tabs on your iPhone.')} <a href="/{$lang}/mobile/home/">{$l10n->get('Learn More')}&hellip;</a></p>
    </div>

    </div>
  </div>

<div id="secondary">

    <div id="beta_android" class="sub-feature">

        <h3>{$l10n->get('Want to test the latest features?')}</h3>
        <p>{$l10n->get('You’ll get to experience cutting-edge features and provide feedback to help refine and polish what will be in the final release.')}</p>

        {$android_beta_links}

    </div>

    <div id="desktop" class="sub-feature">

        <h3>{$l10n->get('Developer Tools')}</h3>

        <p>{$l10n->get('You can install the mobile version of Firefox to our desktop computer in order to test, provide feedback, and build add-ons.')}</p>

        {$fx_desktop_list}

    </div>

</div>

  <div id="connect">

   <h3>{$l10n->get('Connect With Firefox for Mobile:')}</h3>
   <ul>
      <li class="mail"><a href="/{$lang}/newsletter/about_mobile/">{$l10n->get('Monthly newsletter')}</a></li>
      <li class="twitter"><a href="http://twitter.com/MozMobile">{$l10n->get('Follow us')}</a></li>
      <li class="facebook"><a href="http://www.facebook.com/firefoxformobile">{$l10n->get('Become a fan')}</a></li>
   </ul>

  </div>

</div>
</div>

  <script>
    $(document).ready(function(){

        // Hide the platform span if we have JS as it's only for non-JS users
        $('#desktop_download span').hide();

        // When a platform is selected, hide the other platform download buttons
        $('#desktop_choser').change(function() {
            var platformval =  $('#desktop_choser').val();
            switch (platformval) {
            case 'windows':
                $('#desktop_download > li').hide();
                $('#desktop_windows').show();
                break;
            case 'mac':
                $('#desktop_download > li').hide();
                $('#desktop_mac').show();
                break;
            case 'linux':
                $('#desktop_download > li').hide();
                $('#desktop_linux').show();
                break;
            };
        });

        // Detect platform and default platform choser
        if (navigator.platform.indexOf('Linux') >= 0) {
            $('#desktop_choser').val('linux');
        } else if (navigator.platform.indexOf('Mac') >= 0) {
            $('#desktop_choser').val('mac');
        }
        $('#desktop_choser').change();
    });
  </script>

    <script>// <![CDATA[
      /* Whichever box is taller, make the shorter one the same height */
        $(document).ready(function(){
        h_left = $('#beta_android').height();
        h_right = $('#desktop').height();

        if(h_left >= h_right) {
            $('#desktop').height(h_left);
        }
        if (h_left < h_right) {
            $('#beta_android').height(h_right);
        }
        });
    // ]]></script>

BODY;

$contentfile = $config['file_root'].'/'.$lang.'/mobile/download/content.inc.html';

// build page
require_once $headerfile;
echo $body;
require_once $footerfile;

?>
