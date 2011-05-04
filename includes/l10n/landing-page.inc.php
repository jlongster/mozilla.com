<?php

$body_id = 'home';

$extra_headers .= <<<EXTRA_HEADERS
    <meta name="description" content="{$meta_description}" />

EXTRA_HEADERS;

// dl box
include_once $config['file_root'].'/includes/l10n/dlbox.inc.php';

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

    $extra_css = <<<EXTRA
    <style type="text/css">
        body {
            background-image: url("/img/covehead/firefox/direct/page-background.png");
        }
        #home #main-feature {
            zoom: 1;
        }
        #home #main-feature h2 {
            line-height: 50px;
        }
        #home #main-feature img.screenshot {
            top: auto;
            bottom: 0;
        }
        #home #main-feature img.second-screenshot {
            opacity: 0;
        }
        #home ul#benefits li {
            font-size: 18px;
            max-width:140px;
            padding: 8px 10px;
        }
        #home .download-other {
            text-align: center;
            width: 350px;
        }
        #home .sub-feature.first {
            background: none;
        }
        #home .sub-feature {
            width: 250px;
            padding: 0 20px 100px 60px;
        }

        #home .sub-feature h3 {
            font-size:25px;
        }

    </style>
EXTRA;
}

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
    $str2  = 'Firefox 4';
}

$downloads = ___('Experience Firefox&nbsp;4');
$file      = $config['file_root'].'/includes/firefox_4_final_downloads_total.json';
if (file_exists($file) && is_readable($file)) {
    $json = json_decode(file_get_contents($file), true);
    if ($json !== null) {
        $downloads = $json['4.0'];
    }
}

if (is_numeric($downloads)) {
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
    $windowmessage = '
    <div id="download-stats">
        <span id="download-count">'.$downloads.'</span>
    </div>';
}

$extra_headers .= <<<EXTRA_HEADERS

    {$home_css}
    {$extra_css}
EXTRA_HEADERS;


// build page
require_once $headerfile;
require_once $contentfile;
require_once $footerfile;
