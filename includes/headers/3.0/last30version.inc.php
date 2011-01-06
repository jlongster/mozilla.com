<?php

preg_match("/\d(?:\.\d+){1,3}(?:[ab]\d)?(?:pre)?/", $_SERVER['PHP_SELF'], $_version_matches);

// If we matched a version and there are releasenotes, either in our current language or english, it's a valid version
if (array_key_exists(0, $_version_matches) && (
        file_exists("{$config['file_root']}/{$lang}/firefox/{$_version_matches[0]}/releasenotes/index.html")
     || file_exists("{$config['file_root']}/en-US/firefox/{$_version_matches[0]}/releasenotes/index.html")
    )) {
    $_version = $_version_matches[0];
}

if (in_array($lang, array('ar', 'fa', 'he'))) {
$extra_headers .= <<<EXTRA_HEADERS

<link rel="stylesheet" type="text/css" href="/ar/style/tignish/rtl.css" media="screen" />

EXTRA_HEADERS;
}

$body_class = 'whatsnew-3-0-19';









if (!in_array($lang, array(''))) {

// Download box code for locales
$downloadbox  = '<script type="text/javascript" src="/js/download.js"></script>';
$downloadbox .= '<div id="download-area">';
$downloadbox .= $firefoxDetails->getDownloadBlockForLocale($lang,  array('ancillary_links' => false, 'download_product' => 'Free Upgrade') );
$downloadbox .= '</div>';

$extra_headers .= <<<EXTRA_HEADERS
<style type="text/css">
/* Download Button */

#download-area ul.home-download {
    width: 365px;
    margin: 0 0 0 28px;
    left: auto;
}

#download-area ul.home-download li {
    padding: 0;
    position: relative;
    height: 124px;
}

* html #download-area ul.home-download li {
    background: none;
}

#download-area ul.home-download li a.download-link {
    background-image: url(/img/tignish/firefox/download-button-primary.png);
    height: 124px;
    padding: 0;
}

#download-area ul.home-download li a.download-link span {
    padding: 55px 20px 20px 128px;
    height: 49px;
    display: block;
}

* html #download-area ul.home-download li a.download-link {
    background-image: url(/img/tignish/firefox/download-button-primary-ie.png);
}

#download-area ul.home-download li a:hover {
    background-position: top left;
}

#download-area ul.home-download li a:hover span {
    background: url(/img/tignish/firefox/download-button-primary.png) top right no-repeat;
}

* html #download-area ul.home-download li a.download-link:hover span {
    background: url(/img/tignish/firefox/download-button-primary-ie.png) top right no-repeat;
}

#download-area ul.home-download li a.download-link span { line-height: 1.1; }

#download-area ul.home-download li a.download-link em { color: #38a801; }

#download-area ul.home-download li a.download-link strong {
    font-family: georgia, serif;
    font-weight: normal;
    font-size: 130%;
    padding-right: 27px;
    background: url(/img/tignish/firefox/download-arrow.png) right center no-repeat;
}

#download-area ul.download li a.download-link:hover,
#download-area ul.download li a.download-link:active {
    text-decoration: none;
}

#firefox #main-feature .download-other {
    margin-left: 75px;
    font-size: 70%;
}

.download-noscript { margin-left: 35px; width: 400px; }
.download-noscript h3 { font-size: 120%; margin-bottom: 0; }
.download-noscript h3 span { display: block; font-size: 75%; color: #898378; }
.download-noscript ul { margin-top: 0.5em; }


#download-area {
    margin-left: 130px;
    ma rgin-right:auto;
}

#main-feature h2 {
    padding: 45px 0px 10px 180px;
}

.whatsnew-3-0-19 ul.home-download li a.download-link em {
    letter-spacing: normal;
    margin-top:0.5em;
}

/* locales adjustments */

.locale-sl #download-area ul.home-download li a.download-link strong {
    font-size:120%;
}

.locale-lt #download-area ul.home-download li a.download-link strong {
    font-size:115%;
}

.locale-bg #download-area ul.home-download li a.download-link strong {
    font-size:120%;
}

html[dir="rtl"] #download-area  {
    float:right;
}

html[dir="rtl"] #main-feature h2, html[dir="rtl"] #main-feature p, html[dir="rtl"] #download-area  {
    padding-right : 0;
    margin-right  : 200px;
}

html[dir="rtl"] .whatsnew-3-0-19 #wrapper {
    background-image:url("/img/tignish/firefox/rtl-background-warning.jpg") !important;
}



</style>
EXTRA_HEADERS;
}
else {

// Download box code for locales
$downloadbox  = '<script type="text/javascript" src="/js/download.js"></script>';
$downloadbox .= '<div id="download-area">';
$downloadbox .= $firefoxDetails->getDownloadBlockForLocale($lang,  array('ancillary_links' => false, 'download_product' => 'Free Upgrade') );
$downloadbox .= '</div>';
$downloadbox .= '<div id="no-upgrade-button" class="upgrade-button"><a href="/'.$lang.'/firefox/mu-survey/"><span class="primary">'.$no_download_button1.'</span> <span class="secondary">'.$no_download_button2.'</span></a></div>';

$extra_headers .= <<<EXTRA_HEADERS
<style type="text/css">
.whatsnew-3-0-19 ul.home-download li a.download-link em {
    letter-spacing: normal;
    margin-top:0.5em;
}

#main-feature h2 {
    padding: 45px 0px 10px 180px;
}

</style>
EXTRA_HEADERS;


}

?>
