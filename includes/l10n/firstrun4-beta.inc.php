<?php

$body_id = 'firstrun';

include_once "{$config['file_root']}/includes/l10n/firefox4-beta-functions.inc.php";

// Build our dynamic header

$page_title     = empty($page_title)    ? 'Mozilla.com' : $page_title;
$textdir        = empty($textdir)       ? 'ltr'         : $textdir;
$extra_headers  = empty($extra_headers) ? ''            : $extra_headers;
$extra_feature  = empty($extra_feature) ? ''            : $extra_feature;
$extra_css      = empty($extra_css)     ? ''            : $extra_css;
$body_class     = empty($body_class)    ? ''            : $body_class;

$poscss         = 'float:right; padding-right:35%;';

$subtitles = getVideoSubtitles('mainPlayer', 'includes/l10n/sub-fx4-firstrun-beta.html');

/*
ob_start();
echo '

<div id="mediaPlayer" class="htmlPlayer">
    <div id="mediaDescription">';
@include_once "{$config['file_root']}/{$lang}/includes/l10n/sub-fx4-firstrun-beta.html";
echo '
    </div>
</div>';
$subtitles = ob_get_contents();
ob_clean();
*/

// RTL support for Mozilla.com
if(in_array($lang, array('ar', 'fa', 'he'))) {
    $textdir = 'rtl';
    $poscss         = 'font-size:80%; float:left; padding-left:35%; padding-right:auto;';
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
        top:380px;

        /* those rules are because the webm video is not 640px wide */
        position:absolute;
        left: 0 !important;
        right: 0 !important;
        width: 640px !important;
        margin-top:16px !important; /* subtitles closer to video controls */
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


$screencap_local = $_SERVER['DOCUMENT_ROOT'].'/'.$lang.'/img/fxb4-feedback-button.png';

if (!file_exists($screencap_local)) {
    $screencap = $config['static_prefix'].'/img/firefox/beta/4/firstrun/feedback-button.png';
} else {
    $screencap = $config['static_prefix'].'/'.$lang.'/img/fxb4-feedback-button.png';
}


$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE HTML>
<html xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>{$page_title}</title>

    <script type="text/javascript" src="{$config['static_prefix']}/js/util.js"></script>
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/includes/yui/2.5.1/reset-fonts-grids/reset-fonts-grids.css" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/template.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/content.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/firefox/4/firstrun-page-beta1.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/video-player.css" media="screen" />
    <script type="text/javascript" src="{$config['static_prefix']}/includes/yui/2.5.1/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="{$config['static_prefix']}/includes/yui/2.5.1/container/container_core-min.js"></script>
    <script type="text/javascript" src="{$config['static_prefix']}/includes/yui/2.5.1/animation/animation-min.js"></script>
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

// ]]></script>
{$subtitles}
<div id="wrapper">

<div id="doc">


DYNAMIC_HEADER;

$movie = <<<MOVIE
        <div id="video-launch">
            <a href="http://videos-cdn.mozilla.net/firefox4beta/Firefox_4_beta.webm" id="tour-video"  onclick="dcsMultiTrack('DCS.dcsuri','/firefox4beta/Firefox_4_beta.webm','WT.ti','Firefox 4 Beta Firstrun Video');  videoid='mainPlayer';"><img src="{$config['static_prefix']}/img/firefox/beta/4/video-thumbnail.png" alt="Video thumbnail" /><span>{$l10n->get('Watch the video')}</span></a>
            <script type="text/javascript">
            // <![CDATA[
                Mozilla.VideoPlayer.close_text = '{$l10n->get('Close')}';
                Mozilla.VideoScaler.close_text = '{$l10n->get('Close')}';
            var player_french = new Mozilla.VideoPlayer(
                'tour-video',
                [
                    {
                        url:   'http://videos-cdn.mozilla.net/firefox4beta/Firefox_4_beta.webm',
                        type:  'video/webm; codecs=&quot;vp8, vorbis&quot;',
                        title: '{$l10n->get('WebM format')}'
                    },
                    {
                        url:   'http://videos-cdn.mozilla.net/firefox4beta/Firefox_4_beta.theora.ogv',
                        type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
                        title: '{$l10n->get('Ogg Theora format')}'
                    },
                    {
                        url:   'http://videos-cdn.mozilla.net/firefox4beta/Firefox_4_beta.mp4',
                        type:  'video/mp4',
                        title: '{$l10n->get('MPEG-4 format')}'
                    }
                ],
                'firefox4beta/Firefox_4_beta.mp4'
            );
            // ]]>
            </script>
        </div>
MOVIE;

echo $dynamic_header;

unset($dynamic_header);

?>