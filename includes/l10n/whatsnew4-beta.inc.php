<?php
/*
 * This is a quick and dirty solution to be able to do the Firefox 4 beta releases as fast as possible
 * All beta files will go to the trashcan as soon as Firefox 4 is released, except for subtitling
 */


$body_id = 'whatsnew';

include_once "{$config['file_root']}/includes/l10n/firefox4-beta-functions.inc.php";

// Build our dynamic header

$page_title      = ___('Firefox Updated');
$textdir         = empty($textdir)       ? 'ltr'         : $textdir;
$extra_headers   = empty($extra_headers) ? ''            : $extra_headers;
$extra_feature   = empty($extra_feature) ? ''            : $extra_feature;
$extra_css       = empty($extra_css)     ? ''            : $extra_css;
$extra_footer    = empty($extra_footer)  ? ''            : $extra_footer;
$body_class      = empty($body_class)    ? ''            : $body_class;
$poscss          = 'float:right; padding-right:35%;';
$version         = getVersionBySelf();
$shortversion    = str_replace('4.0b', '', $version);
$latestRelease   = str_replace('4.0b', '', LATEST_FIREFOX_DEVEL_VERSION);
$sub             = '';
$subtitles       = '';
$videoserver     = 'http://videos-cdn.mozilla.net/firefox4beta/';
$videothumbnail  = 'video-frame.png';
$fallback        = false;
$fallbackcontent = $config['file_root'].'/'.$lang.'/includes/l10n/4beta-whatsnew-fallback.inc.php';
$videoid         = '';
$ext_webm        = 'webm';
$ext_theora      = 'theora.ogv';
$ext_mp4         = 'mp4';
$sidebarfile     = $_SERVER['DOCUMENT_ROOT'].'/'.$lang.'/firefox/4beta/whatsnew/sidebar.inc.html';

if (file_exists($sidebarfile)) {
    ob_start();
    include_once $sidebarfile;
    $sidebar = ob_get_contents();
    ob_end_clean();
} else {
    $sidebar = '';
}

// redirect to download page if not the latest whatsnew page.
// This way we can put everything on production before the release.
if ($_SERVER['HTTP_HOST'] == 'www.mozilla.com' && $shortversion > $latestRelease) {
    noCachingRedirect($config['url_scheme'].'://'.$config['server_name']."/$lang/firefox/beta/");
    exit;
}

$shortversion_content = ($shortversion == 6) ? 5 : $shortversion;
$shortversion_content = ($shortversion == 11) ? 10 : $shortversion;
$shortversion_content = ($shortversion == 12) ? 10 : $shortversion;
$cssversion           = $shortversion_content;

switch ($shortversion_content) {
    case 2:
        $video = 'appTabs-480';
        break;
    case 3:
        $fallback = true;
        $screencap_local = $_SERVER['DOCUMENT_ROOT'].'/'.$lang.'/img/fxb4-feedback-button.png';
            if (!file_exists($screencap_local)) {
                $screencap = $config['static_prefix'].'/img/firefox/beta/4/firstrun/feedback-button.png';
            } else {
                $screencap = $config['static_prefix'].'/'.$lang.'/img/fxb4-feedback-button.png';
            }
        $video    = 'SyncFinal';
        $extra_css .=<<<ADJUSTMENTS

    div#mediaDescription div {
        background: rgba(0,0,0,0.5);
    }

    div#mediaDescription div[data-special="blank"] {
        opacity:0 !important;
    }

    #main-content #column-1,
    #main-content #column-2,
    #main-content #column-3 {
        float: left;
        margin-left: 30px;
        width: 235px;
        padding: 1px 0;
    }
    #main-content p {
        font-size: 100% !important;
    }

    #main-content #column-1 {
        width: 355px;
        margin-left: 30px;
    }

    #main-content #column-1 img {
        float: right;
        margin: 5px 0 10px 15px;
    }


ADJUSTMENTS;
        break;
    case 4:
        $video    = 'syncfinalnonen-us';
        $videoid  = 'video-sync';
        $sub      = 'includes/l10n/videos/sub-fx4-sync.html';
        $tabvideo = <<<TABCANDY

        <div id="video-tabcandy-launch" class="video-launch">
            <a href="http://videos-cdn.mozilla.net/serv/firefox4beta/grouptabs.webm" id="video-tabcandy" onclick="dcsMultiTrack('DCS.dcsuri','/serv/firefox4beta/grouptabs.webm','WT.ti','Firefox 4 Beta 3 Whats New Page TabCandy Video');videoid='grouptabs';"><span class="video-launch-border"><img class="video-launch-thumbnail" src="/img/firefox/beta/4/video-frame.png" /></span><span class="video-launch-text">{$l10n->get('Watch the video')}</span></a>
        </div>
TABCANDY;

        $extra_css .=<<<ADJUSTMENTS

    div#grouptabs.subtitles div.active {
        background: rgba(0,0,0,0.5) !important;
        pointer-events:none;
    }

    .subtitles div[data-special="blank"] {
        opacity:0 !important;
    }

    #main-content p {
        font-size: 100% !important;
    }

    div#grouptabs div:first-child {
        /* those rules are because the webm video is not 640px wide */
        left: 0 !important;
        right: 0 !important;
        margin: auto  !important;
        width: 594px !important;
        margin-top:16px !important; /* subtitles closer to video controls */
    }

    div#grouptabs div:first-child div {
        /* those rules are because the webm video is not 640px wide */
        width: 584px !important;

    }

ADJUSTMENTS;
    $video2      = 'grouptabs';
    $subtitles   = getVideoSubtitles($videoid, $sub);
    $subtitles  .= getVideoSubtitles($video2, 'includes/l10n/videos/sub-fx4-panorama.php', true);
    $videoserver = 'http://videos-cdn.mozilla.net/serv/firefox4beta/';

    $extra_footer = <<<FOOTER
    <script type="text/javascript">
    // <![CDATA[

        var player_tabcandy = new Mozilla.VideoPlayer(
        'video-tabcandy',
        [
            {
                url:   '{$videoserver}{$video2}.webm',
                type:  'video/webm; codecs=&quot;vp8, vorbis&quot;',
                title: '{$l10n->get('WebM format')}'
            },
            {
                url:   '{$videoserver}{$video2}.theora.ogv',
                type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                title: '{$l10n->get('Ogg Theora format')}'
            },
            {
                url:   '{$videoserver}{$video2}.mp4',
                type:  'video/mp4',
                title: '{$l10n->get('MPEG-4 format')}'
            }
        ],
        'firefox4beta/{$video2}.mp4'
    );
    // ]]>
    </script>
FOOTER;

        break;

    case 5:

        $video2      = 'fx4beta5'; //d2D
        $subtitles   = getVideoSubtitles($video2, 'includes/l10n/videos/sub-fx4-direct2d.php', true);
        $videoserver = 'http://videos-cdn.mozilla.net/serv/mozhacks/';
        $ext_webm        = 'webm';
        $ext_theora      = 'ogv';
        $ext_mp4         = 'mp4';

        $d2dvideo = <<<D2DVIDEO

        <div id="video-d2d" class="video-launch">
            <a href="http://videos.mozilla.org/serv/mozhacks/fx4beta5.webm" id="video-hardwareaccel" onclick="dcsMultiTrack('DCS.dcsuri','/serv/mozhacks/fx4beta5.webm','WT.ti','Firefox 4 Beta Whats New video');videoid='{$video2}';"><span class="video-launch-border"><img class="video-launch-thumbnail" src="/img/firefox/beta/4/video-frame.png" /></span><span class="video-launch-text">{$l10n->get('Watch the video')}</span></a>
        </div>

D2DVIDEO;

    $extra_footer = <<<FOOTER
    <script type="text/javascript">
    // <![CDATA[

        var player_d2d = new Mozilla.VideoPlayer(
        'video-d2d',
        [
            {
                url:   '{$videoserver}{$video2}.{$ext_webm}',
                type:  'video/webm; codecs=&quot;vp8, vorbis&quot;',
                title: '{$l10n->get('WebM format')}'
            },
            {
                url:   '{$videoserver}{$video2}.{$ext_theora}',
                type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                title: '{$l10n->get('Ogg Theora format')}'
            },
            {
                url:   '{$videoserver}{$video2}.{$ext_mp4}',
                type:  'video/mp4',
                title: '{$l10n->get('MPEG-4 format')}'
            }
        ],
        'firefox4beta/{$video2}.mp4'
    );
    // ]]>
    </script>
FOOTER;

        $extra_css .=<<<ADJUSTMENTS

    div#fx4beta5.subtitles div.active {
        background: rgba(0,0,0,0.5) !important;
        pointer-events:none;
    }

    .subtitles div[data-special="blank"] {
        opacity:0 !important;
    }


ADJUSTMENTS;



        $video       = 'AudioAPI';
        $videoid     = 'audioapi';
        $subtitles  .= getVideoSubtitles('audioapi', 'includes/l10n/videos/sub-fx4-audioapi.php', true);
        $videoserver = 'http://videos-cdn.mozilla.net/serv/firefox4beta/';
        break;

    case '7':
        $video       = 'Ants10';
        $videoid     = 'video-ants';
        $videoserver = 'http://videos-cdn.mozilla.net/serv/firefox4beta/ants/';
        break;

    case '8':
        $video        = 'FlightDemo';
        $videoid      = 'flight';
        $video2       = 'SyncSetupDemo_final';
        $videoid2     = 'video-syncsetup';
        $subtitles    = getVideoSubtitles($videoid, 'includes/l10n/videos/sub-fx4-flight.php', true);
        $videoserver  = 'http://videos-cdn.mozilla.net/serv/firefox4beta/ants/';
        $videoserver2 = 'http://videos-cdn.mozilla.net/serv/air_mozilla/';
        $ext_webm     = 'webm';
        $ext_theora   = 'ogv';
        $ext_mp4      = 'mp4';
        $titleimglk   = $config['static_prefix'].'/img/firefox/beta/4/firstrun/title.png';
        $videolink1   = 'http://videos.mozilla.org/serv/mozhacks/flight-of-the-navigator/';


        $movie2 = <<<SYNC

        <div id="video-sync" class="video-launch">
            <a href="http://videos-cdn.mozilla.net/serv/air_mozilla/SyncSetupDemo_final.webm" id="video-syncsetup" onclick="dcsMultiTrack('DCS.dcsuri','/serv/air_mozilla/SyncSetupDemo_final.webm','WT.ti','Firefox 4 Beta 8 Sync setup video');videoid='{$video2}';"><span class="video-launch-border"><img class="video-launch-thumbnail" src="/img/firefox/beta/4/video-frame.png" /></span><span class="video-launch-text">{$l10n->get('Watch the video')}</span></a>
        </div>

SYNC;

    $extra_footer = <<<FOOTER
    <script type="text/javascript">
    // <![CDATA[

    var player_syncsetup = new Mozilla.VideoPlayer(
        'video-syncsetup',
        [
            {
                url:   '{$videoserver2}{$video2}.webm',
                type:  'video/webm; codecs=&quot;vp8, vorbis&quot;',
                title: '{$l10n->get('WebM format')}'
            },
            {
                url:   '{$videoserver2}{$video2}.theora.ogv',
                type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                title: '{$l10n->get('Ogg Theora format')}'
            },
            {
                url:   '{$videoserver2}{$video2}.mp4',
                type:  'video/mp4',
                title: '{$l10n->get('MPEG-4 format')}'
            }
        ],
        'serv/air_mozilla/{$video2}.mp4'
    );



    // ]]>
    </script>
FOOTER;

        break;

    case '9':

        $video        = 'Firefox_4_beta';
        $videoid      = 'tour-video';
        $video2       = 'grouptabs';
        $subtitles    = getVideoSubtitles($videoid, 'includes/l10n/sub-fx4-firstrun-beta.html');
        $subtitles   .= getVideoSubtitles($video2, 'includes/l10n/videos/sub-fx4-panorama.php', true);
        $videoserver  = 'http://videos-cdn.mozilla.net/serv/firefox4beta/';
        $titleimglk   = $config['static_prefix'].'/img/firefox/beta/4/firstrun/title.png';


        $panoramavideo = <<<TABCANDY
        <div id="video-sync" class="video-launch">
            <a href="http://videos-cdn.mozilla.net/serv/firefox4beta/grouptabs.webm" id="video-grouptabs" onclick="dcsMultiTrack('DCS.dcsuri', '/serv/firefox4beta/grouptabs.webm','WT.ti','Firefox 4 Beta 9 Group tabs video'); videoid='grouptabs';">
              <div class="video-launch-border">
                <img class="video-launch-thumbnail" src="/img/firefox/beta/4/video-frame.png" />
              </div>
              <span class="video-launch-text">{$l10n->get('Watch the video')}</span>
            </a>
        </div>
TABCANDY;

        $extra_css .=<<<ADJUSTMENTS

    div#grouptabs.subtitles div.active {
        background: rgba(0,0,0,0.5) !important;
        pointer-events:none;
    }

    .subtitles div[data-special="blank"] {
        opacity:0 !important;
    }

    #main-content p {
        font-size: 100% !important;
    }

    div#grouptabs div:first-child {
        /* those rules are because the webm video is not 640px wide */
        left: 0 !important;
        right: 0 !important;
        margin: auto  !important;
        width: 594px !important;
        margin-top:16px !important; /* subtitles closer to video controls */
    }

    div#grouptabs div:first-child div {
        /* those rules are because the webm video is not 640px wide */
        width: 584px !important;

    }

ADJUSTMENTS;
$extra_css .=<<<SUBTITLES

    #mediaPlayer, .subtitles {
        position:relative;
        z-index:10000;
        margin:auto;
        top:380px;

        /* those rules are because the webm video is not 640px wide */
        position:absolute;
        left: 0 !important;
        right: 0 !important;
        width: 640px !important;
    }

    div#mediaDescription, .subtitles div:first-child {
      overflow: none;
      position: absolute;
      width: 640px !important;
      text-align:center;
      height:2.5em;
    }

    div#mediaDescription div, .subtitles div:first-child > div {
      background: rgba(0,0,0,0.2);
      padding:5px 0;
      position: relative;
      height:2.5em;
      opacity: 0;
      display:none;
    }

    div#mediaDescription div.active, .subtitles div:first-child > div.active {
      opacity: 1;
      display:block;
      font-family: sans-serif;
      font-weight: bold;
      font-size: 1.1em;
      color: white;
      text-shadow: black 1px 1px 3px;
      pointer-events:none;

    }

    div#mediaDescription div.active a, .subtitles div:first-child > div.active a {
      color: orange;
    }

    div#mediaDescription div.active a:hover, .subtitles div:first-child > div a:hover {
      color: white;
    }

    div[data-start="11.14"], div[data-start="18.32"], div[data-start="44.63"], div[data-start="49.85"]  {
        margin-top: -3em !important;
    }

SUBTITLES;




$extra_css .=<<<ADJUSTMENTS

h1 {
    text-shadow: 0 0 1px black !important;
}


html[lang=de] #video-launch {
    right:15px;
}

html[lang=et] h1 {
    font-size: 43px !important;
    margin-left: -20px !important;
}

ADJUSTMENTS;

    $extra_footer = <<<FOOTER
    <script type="text/javascript">
    // <![CDATA[

        var player_tabcandy = new Mozilla.VideoPlayer(
        'video-grouptabs',
        [
            {
                url:   '{$videoserver}{$video2}.webm',
                type:  'video/webm; codecs=&quot;vp8, vorbis&quot;',
                title: '{$l10n->get('WebM format')}'
            },
            {
                url:   '{$videoserver}{$video2}.theora.ogv',
                type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                title: '{$l10n->get('Ogg Theora format')}'
            },
            {
                url:   '{$videoserver}{$video2}.mp4',
                type:  'video/mp4',
                title: '{$l10n->get('MPEG-4 format')}'
            }
        ],
        'firefox4beta/{$video2}.mp4'
    );
    // ]]>
    </script>
FOOTER;

        break;

    case '10':
    case '11':
    case '12':
        $video       = 'Firefox_4_beta';
        $videoid     = 'tour-video';
        $subtitles   = getVideoSubtitles($videoid, 'includes/l10n/sub-fx4-firstrun-beta.html');
        $videoserver = 'http://videos-cdn.mozilla.net/serv/firefox4beta/';
        $titleimglk  = $config['static_prefix'].'/img/firefox/beta/4/firstrun/title.png';
        $feedbackurl = 'http://input.mozilla.com/feedback';
        $li_relnotes = '<li><a href="/'.$lang.'/firefox/'.$version.'/releasenotes/">'.___('Release Notes').' »</a></li>';
        break;

    default:
        break;
}





// RTL support for Mozilla.com
if(in_array($lang, array('ar', 'fa', 'he'))) {
    $textdir = 'rtl';
    $poscss  = 'font-size:80%; float:left; padding-left:35%; padding-right:auto;';
    $extra_css .=<<<EXTRA_CSS

    #main-content #column-1, #main-content #column-2, #main-content #column-3 {
        float:right !important;
        margin-right:30px !important;
        margin-left:0 !important;
    }

    #sub-feature  {
        left:-203px !important;
    }

    #video-launch  {
        right:auto !important;
        left:35px !important;
    }

    #main-feature p, #main-feature ul {
        margin:0 80px 10px 250px;
    }

    #video-launch span {
        padding-left:35px;
        padding-left:auto;
    }
    #main-content #column-1 img {
        float:left;
    }

    h1 {
        text-align: left;
    }


EXTRA_CSS;
}


$extra_css .=<<<SUBTITLES

    #mediaPlayer, .subtitles {
        position:relative;
        z-index:10000;
        margin:auto;
        width:640px;
        top:380px;

    }

    div#mediaDescription, .subtitles div:first-child {
      overflow: none;
      position: absolute;
      width:640px;
      text-align:center;
      height:2.5em;
    }

    div#mediaDescription div, .subtitles div:first-child > div {
      background: rgba(0,0,0,0.2);
      position: relative;
      height:2.5em;
      padding:5px 0;
      opacity: 0;
      display:none;
    }

    div#mediaDescription div.active, .subtitles div:first-child > div.active {
      opacity: 1;
      display:block;
      font-family: sans-serif;
      font-weight: bold;
      font-size: 1.1em;
      color: white;
      text-shadow: black 1px 1px 3px;

    }

    div#mediaDescription div.active a, .subtitles div:first-child > div.active a {
      color: orange;
    }

    div#mediaDescription div.active a:hover, .subtitles div:first-child > div a:hover {
      color: white;
    }


SUBTITLES;


$extra_css .=<<<ADJUSTMENTS

h1 {
    text-shadow: 0 0 1px black !important;
}


html[lang=de] #video-launch {
    right:15px;
}

html[lang=et] h1 {
    font-size: 43px !important;
    margin-left: -20px !important;
}

#main-feature #sub-feature {
    min-height: 200px;
}

ADJUSTMENTS;


$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE HTML>
<html xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>{$page_title}</title>

    <script type="text/javascript" src="{$config['static_prefix']}/includes/min/min.js?g=js"></script>
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/includes/yui/2.5.1/reset-fonts-grids/reset-fonts-grids.css" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/template.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/content.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/firefox/4/firstrun-page-beta{$cssversion}.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/video-player.css" media="screen" />
    <script type="text/javascript" src="{$config['static_prefix']}/js/mozilla-video-tools-addsubtitles.js"></script>
    <script type="text/javascript" src="{$config['static_prefix']}/js/mozilla-video-tools.js"></script>

    <style type="text/css">
    {$extra_css}
    </style>

    {$extra_headers}

</head>

<body id="{$body_id}" class="{$body_class} locale-{$lang} portal-page">
<script type="text/javascript">// <![CDATA[

if (document.body.className == '') {
    document.body.className = 'js';
} else {
    document.body.className += ' js';
}

if (gPlatform == 1) {
    document.body.className += ' platform-windows';
} else if (gPlatform == 3 || gPlatform == 4) {
    document.body.className += ' platform-mac';
} else if (gPlatform == 2) {
    document.body.className += ' platform-linux';
}

// css transition effect
$(document).ready(function() {
    document.body.offsetLeft;
    document.getElementById('sub-feature').className = 'loaded';
});




// ]]></script>
{$subtitles}
<div id="wrapper">

<div id="doc">


DYNAMIC_HEADER;


if (!isset($movie)) {
$movie = <<<MOVIE
        <div id="video-launch" class="video-launch">
            <a href="{$videoserver}{$video}.webm" id="{$videoid}-vid" onclick="videoid='{$videoid}';"><span id="video-launch-border"><img src="{$config['static_prefix']}/img/firefox/beta/4/video-thumbnail.png" alt="Video thumbnail" /></span><span id="video-launch-text" class="video-launch-text">{$l10n->get('Watch the video')}</span></a>
            <script type="text/javascript">
            // <![CDATA[
                Mozilla.VideoPlayer.close_text = '{$l10n->get('Close')}';
                Mozilla.VideoScaler.close_text = '{$l10n->get('Close')}';
                var player_sync = new Mozilla.VideoPlayer(
                '{$videoid}-vid',
                [
                    {
                        url:   '{$videoserver}{$video}.{$ext_webm}',
                        type:  'video/webm; codecs=&quot;vp8, vorbis&quot;',
                        title: '{$l10n->get('WebM format')}'
                    },
                    {
                        url:   '{$videoserver}{$video}.{$ext_theora}',
                        type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                        title: '{$l10n->get('Ogg Theora format')}'
                    },
                    {
                        url:   '{$videoserver}{$video}.{$ext_mp4}',
                        type:  'video/mp4',
                        title: '{$l10n->get('MPEG-4 format')}'
                    }
                ],
                'firefox4beta/{$video}.mp4'
            );
            // ]]>
            </script>
        </div>
MOVIE;
}

echo $dynamic_header;

unset($dynamic_header);

// get content page
$content = '/firefox/4beta/whatsnew/content-beta'.$shortversion_content.'.html';

if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$lang.$content)) {
        $target = $config['file_root'].'/'.$lang.$content;
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'].'/en-GB'.$content)) {
        $target = $config['file_root'].'/en-GB'.$content;
    } else {
        noCachingRedirect($config['url_scheme'].'://'.$config['server_name'].'/en-US/firefox/'.$version.'/whatsnew/');
}

// spit out the buffered content
ob_start();
include_once $target;
$contents = ob_get_contents();
ob_end_clean();
// special 4.0b6 case, we have the same page as beta 5 but just want to change the release notes link
if ($shortversion == 6) { $contents = str_replace('/4.0b5/', '/4.0b6/',$contents);}
echo $contents;
unset($contents);

include_once "{$config['file_root']}/includes/l10n/whatsnew4-beta-footer.inc.php";

?>
