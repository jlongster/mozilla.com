<?php

$body_id = 'home';

$extra_headers .= <<<EXTRA_HEADERS
    <meta name="og:image" content="http://mozcom-cdn.mozilla.net/img/firefox-100.jpg">
    <meta name="description" content="{$meta_description}" />

EXTRA_HEADERS;

$target   = 'normal';
$home_css = '<link rel="stylesheet" type="text/css" href="' . $config['static_prefix'] . '/style/covehead/l10n/landing-page.css" media="screen" />';

if (count($_GET) > 0) {
    $getArray = secureText($_GET);
    $getArray = array_keys($getArray);
    $campaigns = array('socialmedia', 'worker', 'streamer', 'gamer', 'messaging');

    foreach($getArray as $val) {
        if (in_array($val, $campaigns)) {
            include_once $config['file_root'].'/includes/min/inline.php';
            $home_css = min_inline_css('css_home');
            $target   = $val;
            $l10n->load($config['file_root'].'/'.$lang.'/includes/l10n/home.lang');
            break;
        }
    }

    // AB testing campaign
    if ($target == 'normal' && $lang == 'fr') {
        foreach($getArray as $val) {
            if (in_array($val, array('AB1', 'AB2', 'AB3'))) {
                $target   = $val;
                $l10n->load($config['file_root'].'/'.$lang.'/includes/l10n/home.lang');
                break;
            }
        }
    }

    // XP conversion campaign
    if ($target == 'normal' && (in_array('xp', $getArray) || in_array('XP', $getArray)) ) {

        $target = 'XP';

        if ($stage == false) {

            if (   i__('Mozilla Firefox. Bringing the modern Web to XP.') == false
                || i__('Super speed') == false
                || i__('Stunning graphics') == false
                || i__('The latest technologies') == false ) {

                $target = 'normal';
            }
        }
    }

    $extra_css = <<<EXTRA

        #home body {
            background-image: url("/img/covehead/firefox/direct/page-background.png");
        }
        #home #header {
            margin-bottom: 0 !important;
        }
        #home #main-feature {
            zoom: 1 !important;
        }
        #home #main-feature h2 {
            line-height: 50px !important;
            padding: 60px 0 0 0 !important;
            font-style: italic !important;
            width: 420px !important;
        }
        #home #main-feature img.screenshot {
            top: auto !important;
            bottom: 0 !important;
        }
        #home #main-feature img.second-screenshot {
            opacity: 0;
        }

        #home ul#benefits {
            min-height: 40px !important;
        }
        #home ul#benefits li {
            font-size: 18px !important;
            width:120px !important;
            padding: 0 10px !important;
            margin-bottom: 5px!important;
        }
        #home .download-other {
            text-align: center !important;
            width: 350px !important;
        }
        #home .sub-feature.first {
            background: none !important;
        }
        #home .sub-feature {
            width: 250px !important;
            padding-top: 0!important;
            padding-bottom: 100px!important;
            padding-left: 60px !important;
            padding-right: 20px !important;
        }

        #home #sub-security.sub-feature {
            padding-right: 0px !important;
        }

        #home .sub-feature h3 {
            font-size:25px !important;
        }


EXTRA;
}

// dl box
include $config['file_root'].'/includes/l10n/dlbox.inc.php';

switch($target) {
    case 'socialmedia':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.social.inc.php';
        break;

    case 'worker':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.worker.inc.php';
        break;

    case 'gamer':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.gamer.inc.php';
        break;

    case 'messaging':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.messaging.inc.php';
        break;

    case 'streamer':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.streamer.inc.php';
        break;

    case 'AB1':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.abtesting1.inc.php';
        $abtest = true;
        $extra_css = '';
        break;

    case 'AB2':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.abtesting2.inc.php';
        $abtest = true;

        $extra_css .= <<<EXTRA

        #home #main-content {
            margin: 20px 0 0;
        }

        #home .sub-feature {
            float: left;
            font-size: 16px;
            padding: 20px !important;
            position: relative;
            width: 200px !important;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAAwCAMAAADjGDCOAAAAElBMVEXq6urAwMDBwcHp6en29vb///+NcJSLAAAAPElEQVQI12WOwQ0AMQzCTAL7r9zfXZM+LUsGLHA1SUiCq7G4GKzfJ8FqXEzWaowmyzM31O+Hm9fHr1F9AMllAhxqMpx9AAAAAElFTkSuQmCC") no-repeat scroll 0 70px transparent;
        }
        #home .sub-feature p {
            min-height: 50px !important;
        }

        #home #sub-firefox.sub-feature p {
            min-height: 20px !important;
            line-height: inherit;
        }

        #home #sub-firefox.sub-feature {
            background: none repeat scroll 0 0 transparent;
            padding-right: 5px;
            padding-left: 5px !important;
            width: 230px !important;
            margin-left:0;
        }

        #home #sub-firefox.sub-feature h3 {
            font-size: 36px;
            margin-bottom: 5px;
        }

        #home .sub-feature h3 {
            font-size: 25px;
            margin-bottom: 5px;
            margin-top:0;
        }

        #home #sub-firefox.sub-feature p a:after {
            padding:0;
            content: "" !important;
        }

        #home #sub-firefox.sub-feature a {
            background: url("data:image/png;base64,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") no-repeat scroll 0 50% transparent;
            float: left;
            font-size: 17px;
            letter-spacing: -0.02em;
            padding: 5px 5px 5px 40px;
        }

         #home #mobile-promo {
            color: #6D7581;
            font-size: 13px;
            margin: 0;
            padding: 15px 30px 0px 60px;
            text-align: right;
            width: 240px;
        }

        #home ul#benefits {
            font-size: 22px;
            font-style: italic;
            padding: 0;
            margin: 10px 0 20px 0;
        }

        #home ul#benefits li {
            float: left;
            margin: 0 0 40px 0;
            list-style-type: none;
            text-align: center;
            padding: 8px 20px;
            line-height: 19px;
            color: #484848;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAAwCAMAAADjGDCOAAAAElBMVEXq6urAwMDBwcHp6en29vb///+NcJSLAAAAPElEQVQI12WOwQ0AMQzCTAL7r9zfXZM+LUsGLHA1SUiCq7G4GKzfJ8FqXEzWaowmyzM31O+Hm9fHr1F9AMllAhxqMpx9AAAAAElFTkSuQmCC") 0 6px no-repeat;
            *background-image: url('/img/covehead/firefox/dotted-divider.png'); /* IE6 and IE7 only */
        }

        #home ul#benefits li.first {
            padding-left: 5px;
            background: none;
            margin-top: 0.5em;
        }

        #home ul#benefits li span {
            display: block;
        }

        #home ul#benefits {
            min-height: 40px !important;
        }

        #home ul#benefits li {
            font-size: 18px !important;
            width:120px !important;
            padding: 0 10px !important;
            margin-bottom: 5px!important;
        }

        #home #home-download {
            clear: left;
            padding-left: 0;
            position: relative;
            z-index: 25;
            margin-top:40px;
        }

EXTRA;
        break;

    case 'AB3':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.abtesting3.inc.php';
        $abtest = true;

        $extra_css .= <<<EXTRA

        html {
            background-color: white;
        }

        #home #doc {
            margin-bottom: 0 !important;
        }

        #home #header h1 a {
            display:none !important;
        }

         #home #mobile-promo {
            color: #6D7581;
            font-size: 13px;
            margin: 0;
            padding: 15px 30px 0px 60px;
            text-align: right;
            width: 240px;
        }

        #home ul#benefits {
            font-size: 22px;
            font-style: italic;
            padding: 0;
            margin: 10px 0 20px 0;
        }

        #home ul#benefits li {
            float: left;
            margin: 0 0 40px 0;
            list-style-type: none;
            text-align: center;
            padding: 8px 20px;
            line-height: 19px;
            color: #484848;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAAwCAMAAADjGDCOAAAAElBMVEXq6urAwMDBwcHp6en29vb///+NcJSLAAAAPElEQVQI12WOwQ0AMQzCTAL7r9zfXZM+LUsGLHA1SUiCq7G4GKzfJ8FqXEzWaowmyzM31O+Hm9fHr1F9AMllAhxqMpx9AAAAAElFTkSuQmCC") 0 6px no-repeat;
            *background-image: url('/img/covehead/firefox/dotted-divider.png'); /* IE6 and IE7 only */
        }

        #home ul#benefits li.first {
            padding-left: 5px;
            background: none;
            margin-top: 0.5em;
        }

        #home ul#benefits li span {
            display: block;
        }

        #home ul#benefits {
            min-height: 40px !important;
        }

        #home ul#benefits li {
            font-size: 18px !important;
            width:120px !important;
            padding: 0 10px !important;
            margin-bottom: 5px!important;
        }

        #home #home-download {
            clear: left;
            padding-left: 0;
            position: relative;
            z-index: 25;
            margin-top:40px;
        }

EXTRA;
        break;

    case 'XP':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.xpcampaign.inc.php';
        $extra_css = '';
        $firefoxDetailsl10n->download_base_url_transition = "/$lang/download/";
        $firefoxDetailsl10n->has_transition_download_page = $XPCampaignTransitionPage;
        break;
    case 'normal':
    default:
        $contentfile = $config['file_root'].'/includes/l10n/4/fallback.home.inc.php';
        $extra_css = '';
        break;
}




// we extract a few strings from another project
$retour  = true;
$details = $config['file_root'].'/'.$lang.'/firefox/4/details/index.html';
if (file_exists($details)) {
    $promo = true;
    include $details;
} else {
    $promo = false;
    $str2  = 'Firefox';
}

$downloads = ___('Experience Firefox');
$file      = $config['file_root'].'/includes/firefox_4_final_downloads_total.json';
if (file_exists($file) && is_readable($file)) {
    $json = json_decode(file_get_contents($file), true);
    if ($json !== null) {
        $downloads = $json['4.0'];
    }
}

if (is_numeric($downloads)) {
    $download_ok = true;
    // regional numbers formatting
    if (!in_array($lang, array('as', 'bn-BD', 'bn-IN', 'en-GB', 'en-US', 'gu-IN', 'ga-IE', 'he', 'hi-IN', 'ja', 'kn', 'ml', 'mr', 'or', 'pa-IN', 'si', 'ta', 'ta-LK', 'te', 'th', 'zh-CN', 'zh-TW'))) {
        $downloads = number_format($downloads, 0, ',', '.');
    } else {
        $downloads = number_format($downloads, 0, '.', ',');
    }

    $windowmessage = '
    <div id="download-stats">
        <h4><img src="/img/home/download-arrow.png"/></h4>
        <p><span id="download-count">+ '.$downloads.'</span></p>
    </div>';

} else {
    $download_ok   = false;
    $windowmessage = '
    <div id="download-stats">
        <span id="download-count">'.$downloads.'</span>
    </div>';
}

$extra_headers .= <<<EXTRA_HEADERS

    {$home_css}

EXTRA_HEADERS;


// build page
require_once $headerfile;
require_once $contentfile;
require_once $footerfile;
