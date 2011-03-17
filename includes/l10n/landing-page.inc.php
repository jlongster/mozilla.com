<?php

$body_id    = 'home';
$html5      = true;

$extra_headers .= <<<EXTRA_HEADERS
    <meta name="description" content="{$meta_description}" />

EXTRA_HEADERS;

// dl box
include_once $config['file_root'].'/includes/l10n/dlbox.inc.php';


// Fx 4 page activated when product-details switches to 4.0
$oldfile = $config['file_root'].'/'.$lang.'/firefox/fx36.inc.html';
$fx4file = $config['file_root'].'/'.$lang.'/firefox/fx4.inc.html';


// this is our fallback page
if(!file_exists($fx4file)) {
    $fx4file = $config['file_root'].'/includes/l10n/4/fallback.home.inc.php';
}


if(isset($_GET['fx4']) && intval($_GET['fx4']) == 1) {
    $fx4released = true;
}

if($fx4released) {
    $contentfile = $fx4file;
    $retour = true;
    $details = $config['file_root'].'/'.$lang.'/firefox/4/details/index.html';
    if(file_exists($details)) {
        $promo = true;
        include $details;
    } else {
        $promo = false;
        $str2 = 'Firefox 4';
    }

    $downloads = ___('Experience Firefox&nbsp;4');
    $file = "{$config['file_root']}/includes/firefox_4_final_downloads_total.json";
    if (file_exists($file) && is_readable($file)) {
        $json = json_decode(file_get_contents($file), true);
        if ($json !== null) {
            $downloads = ___('Experience Firefox&nbsp;4');
        }
    }

    if(is_numeric($downloads)) {
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
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/landing-page-l10n-fx4.css" media="screen" />
EXTRA_HEADERS;

} else {
    $contentfile = $oldfile;
    $extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/landing-page-l10n.css" media="screen" />
EXTRA_HEADERS;

}

// build page
require_once $headerfile;
require_once $contentfile;
require_once $footerfile;



?>
