<?php

/**
 * Processing of the Download transition page for locales
 */

// get commodity functions
// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';
require_once $config['file_root'].'/includes/l10n/locale-transition-status.inc.php';

// redirect if malformed url to firefox download page
if (!isset($_GET['product']) || !isset($_GET['lang']) || !isset($_GET['os'])) {
    noCachingRedirect('http://www.mozilla.com/firefox/');
}

$page_title    = 'Mozilla - '.___('Download');
$body_id       = 'download';
$dl_product    = htmlspecialchars(strip_tags($_GET['product']), ENT_QUOTES);
$dl_lang       = htmlspecialchars(strip_tags($_GET['lang']), ENT_QUOTES);
$dl_os         = htmlspecialchars(strip_tags($_GET['os']), ENT_QUOTES);

if (isset($_GET['extra'])) {
    $extra = secureText($_GET['extra']);
} else {
    $extra = '';
}


$nodownload    = (isset($_GET['nodownload'])) ? true: false;
$dl_link       = "http://download.mozilla.org/?product={$dl_product}&os={$dl_os}&lang={$dl_lang}";
$extracontent1 = $extracontent2 = '';
$betastyling   = '';
$beta_download = (in_array($dl_product, $betas)) ? true : false;

if ($beta_download) {

    $betastyling = <<<BETA_STYLING
<link rel="stylesheet" type="text/css" href="/style/firefox/beta/4/main.css"  />

<style type="text/css">



#download #wrapper {
    background:none;

}



#download #main-feature {
    min-height:199px;
    margin-right: 50px;
}

#download-message #main-feature p.manual-download {
    margin:0 50px 0 0;
}

#content {
    color:#4B4742;
    font-size:145%;
    min-height:150px;
}

body[id="download"] #content {
    background:url("/img/firefox/beta/4/tech-table-borders.png") no-repeat scroll 0 0 #F9F9F9 !important;
    width:880px !important;
    height:100px !important;
    padding: 0 !important;
    margin-left: 40px !important;
    margin-top: 30px !important;
}

body[id="download"] #content p {
    background:url("/img/firefox/beta/4/tech-table-borders.png") no-repeat scroll 100% 100% transparent;
    width:780px !important;
    padding:40px 20px 0 80px !important;
    min-height:130px !important;
    height:130px !important;
}

</style>
BETA_STYLING;
}



$extra_headers = <<<EXTRA_HEADERS
<link rel="stylesheet" type="text/css" href="/style/covehead/download-page.css" media="screen" />
<style type⁼"text/css">
#wrapper {
    background: url("/img/covehead/firefox/survey/thanks-background.png") no-repeat scroll 1100px 150px transparent;
    min-height: 700px;
}

#download-message {
    margin-top:150px;
    margin-right:100px;
}


#download-message #main-feature p.manual-download, #download-message #main-feature-fallback p.manual-download {
    font-size: 18px;
    margin: 0;
}

</style>



{$betastyling}

<meta name="WT.si_n" content="DownloadFirefox">
<meta name="WT.si_x" content="1">
<meta name="WT.si_cs" content="1">
EXTRA_HEADERS;

if (!$nodownload) {
    $extra_footers .= get_include_contents("{$config['file_root']}/js/download-transition-l10n.js");
}

if (!isset($extra_headers)) {
    $extra_headers = '';
}

if (!isset($extra_css)) {
    $extra_css = '';
}


if($extra == 'XPUpgrade') {
    // extra tracking code for the XP campaign will go there and be added to the footer
    $extra_footers .= <<<EXTRA_FOOTERS
EXTRA_FOOTERS;
}


require_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";

$content = $_SERVER['DOCUMENT_ROOT'].'/'.$lang.'/download/content.inc.html';

if (!file_exists($content)) {
    include_once $_SERVER['DOCUMENT_ROOT'].'/en-GB/download/content.inc.html';
} else {
    include_once $content;
}

require_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
