<?php

    $body_id    = 'firefox-home';
    $html5      = true;
    $extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/mobile-home-app.css" media="screen" />
    <link rel="stylesheet" href="{$config['static_prefix']}/style/tignish/video-player.css" media="screen" />
    <script src="/includes/yui/2.5.1/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script src="/includes/yui/2.5.1/animation/animation-min.js"></script>
    <script src="/includes/yui/2.5.1/container/container-min.js"></script>
    <script src="{$config['static_prefix']}/js/mozilla-video-tools.js"></script>
EXTRA_HEADERS;

    $extra_footers = <<<EXTRA_FOOTERS
    <script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/js/mobile-home.js"></script>
EXTRA_FOOTERS;

$page_title    = empty($page_title)    ? 'Mozilla.com' : $page_title;
$textdir       = empty($textdir)       ? 'ltr'         : $textdir;
$extra_headers = empty($extra_headers) ? ''            : $extra_headers;
$extra_feature = empty($extra_feature) ? ''            : $extra_feature;
$extra_css     = empty($extra_css)     ? ''            : $extra_css;
$body_class    = empty($body_class)    ? ''            : $body_class;


$ituneslink = 'http://itunes.apple.com/us/app/firefox-home/id380366933?mt=8';
$anchor     = 'My_data_doesn_t_show_up_at_all';

$extra_css = <<<EXTRA_CSS

    #firefox-home #main-feature h2 {
        margin-right:376px !important;
    }

    #firefox-home #main-features li.onthego,
    #firefox-home #main-features li.less,
    #firefox-home #main-features li.search {
        min-height:135px !important;
    }

    #main-features li h4, #main-features li span {
        font-size:130% !important;
    }

    .features-divider {
        display:none;
    }

    #main-feature p.dl {
        display:none;
    }

    #firefox-home a.download-link span {
        padding: 13px 5px 15px 50px !important;
    }

    #firefox-home #main-content {
        background: url("/img/covehead/divider-main.jpg") no-repeat scroll 50% 0 transparent;
        clear: both;
        min-height: 100px;
        padding-top: 30px;
    }

    #firefox-home #sidebar {
        clear: none !important;
        margin: 0 !important;
        width: 260px !important;
    }

    #firefox-home #sidebar h3, #firefox-home #sidebar h4 {
        margin:0;
    }

    #firefox-home #sidebar ol {
        margin:0;
    }

EXTRA_CSS;


switch($lang) {
    case "de":
        $ituneslang = "de";
        $extra_css .= "#firefox-home #main-feature .download-link em {font-size:61% !important; position:relative; top:15px; margin-left:-48px !important;} #firefox-home #main-content h3 {font-size:190% !important;}";
        break;
    case "en-GB":
        $ituneslang = "us";
        break;
    case "es-AR":
        $ituneslang = "es";
        break;
    case "es-CL":
        $ituneslang = "es";
        break;
    case "es-ES":
        $ituneslang = "es";
        $extra_css .= "#firefox-home #main-feature .download-link em {font-size:61% !important;}";
        break;
    case "es-MX":
        $ituneslang = "es";
        break;
    case "fr":
        $ituneslang = "fr";
        $extra_css .= "#firefox-home #main-feature .download-link em {display:inline-block;font-size:70% !important;line-height:1.1em;margin-top:0.5em;}";
        break;
    case "it":
        $ituneslang = "it";
        break;
    case "nl":
        $ituneslang = "nl";
        $extra_css .= "#firefox-home #main-feature .download-link em {font-size:68% !important;}";
        $anchor     = "Mijn_gegevens_verschijnen_helemaal_niet";
        break;
    case "pl":
        $ituneslang = "us";
        $extra_css .= "#firefox-home #main-feature h2 {font-size:350% !important;}";
        break;
    case "zh-CN":
        $ituneslang = "cn";
        break;
    default:
        $ituneslang = "us";
        break;
}

$ituneslink = 'http://itunes.apple.com/'.$ituneslang.'/app/firefox-home/id380366933?mt=8';
$sumolink1  = 'http://support.mozilla.com/'.$lang.'/kb/Cannot+log+in+to+Firefox+Home+App';
$sumolink2  = 'http://support.mozilla.com/'.$lang.'/kb/Firefox+Home+does+not+work#'.$anchor;
$sumolink3  = 'http://support.mozilla.com/1/firefox-home/1.0/iPhone/'.$lang.'/install';


$sidemenu = <<<SIDEMENU
<div>
    <ul id="side-menu">
        <li class="first"><h3><a href="/{$lang}/products/">{$l10n->get('Products')}</a> / <a href="/{$lang}/mobile/">{$l10n->get('Mobile')}</a></h3></li>
        <li><span>{$page_title}</span></li>
        <li><a href="/{$lang}/mobile/home/1.0/releasenotes/">{$l10n->get('Release Notes')}</a></li>
        <li><a href="/{$lang}/mobile/home/faq/">{$l10n->get('FAQ')}</a></li>
    </ul>
</div>
SIDEMENU;

$sidemenu = ''; //removed in nova design

$video = <<<VIDEO
    <li class="video">
      <a href="#" id="tour-video">
      <img src="{$config['static_prefix']}/img/mobile/home-video-thumb.jpg" alt="{$l10n->get('See Firefox Home in action')}" width="255" height="148" />
        <span>{$video_title}</span>
      </a>
      <script type="text/javascript">
      // <![CDATA[
            Mozilla.VideoPlayer.close_text = '{$l10n->get('Close')}';
            Mozilla.VideoScaler.close_text = '{$l10n->get('Close')}';
      var player_french = new Mozilla.VideoPlayer(
        'tour-video',
        [
          {
            url:   'http://videos-cdn.mozilla.net/serv/mobile/firefox-home.webm',
            type:  'video/webm',
            title: '{$l10n->get('WebM format')}'
          },
          {
            url:   'http://videos-cdn.mozilla.net/serv/mobile/firefox-home.ogv',
            type:  'video/ogg; codecs=&quot;theora, vorbis&quot;',
            title: '{$l10n->get('Ogg Theora format')}'
          },
          {
            url:   'http://videos-cdn.mozilla.net/serv/mobile/firefox-home.mp4',
            type:  'video/mp4',
            title: '{$l10n->get('MPEG-4 format')}'
          },
          {
            url:   'http://att.universalrepublic.umrg.com/community/artist/album.aspx?pid=12218&mid=329547',
            type:  '',
            title: '{$music_credit}'
          }
        ],
        'serv/mobile/firefox-home.mp4'
      );
      // ]]>
      </script>
    </li>

VIDEO;

$extra_top_text = <<<TOPTEXT
<div id="download" class="top-right">
<a href="http://itunes.apple.com/us/app/firefox-home/id380366933?mt=8" class="download-link">
  <span>{$l10n->get('Free Download')}</span>
</a>
</div>
TOPTEXT;


require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
