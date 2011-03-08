<?php

include_once "{$config['file_root']}/includes/l10n/locale-transition-status.inc.php";

$productionQuality = array('ar', 'cs', 'de', 'es-AR','es-CL', 'es-ES','es-MX', 'et', 'eu', 'fa', 'fi', 'fr', 'fy-NL', 'ga-IE', 'gl', 'he', 'hr', 'hu', 'id', 'is', 'it', 'ko', 'lt', 'mr', 'nb-NO', 'nl', 'pa-IN', 'pl', 'pt-PT', 'rm', 'ro', 'si', 'sk', 'sl', 'sq', 'sr', 'sv-SE', 'te', 'tr', 'uk', 'zh-CN', 'zh-TW');

checkProductionQuality($lang, $productionQuality);

$body_id = 'firefox-beta';
$html5   = true;

// Build our dynamic header

$page_title     = empty($page_title)    ? 'Mozilla.com' : $page_title;
$textdir        = empty($textdir)       ? 'ltr'         : $textdir;
$extra_headers  = empty($extra_headers) ? ''            : $extra_headers;
$extra_feature  = empty($extra_feature) ? ''            : $extra_feature;
$extra_css      = empty($extra_css)     ? ''            : $extra_css;
$body_class     = empty($body_class)    ? ''            : $body_class;

$logo = '<h2><img src="'.$config['static_prefix'].'/img/firefox/beta/4/title.png" alt="Firefox 4 Beta" /></h2>';
$privacylink = '<li><a href="/'.$lang.'/legal/privacy/">'.___('Privacy Policy').'</a></li>';


// background image on top
if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$lang.'/img/beta4screenshot.png')) {
    $screenback = $config['static_prefix'].'/img/firefox/beta/4/screenshot.png';
} else {
    $screenback = $config['static_prefix'].'/'.$lang.'/img/beta4screenshot.png';
}

// feedback button as an <img> tag
if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$lang.'/img/beta4feedback-button.png')) {
    $screencap = $config['static_prefix'].'/img/firefox/beta/4/feedback-button.png';
} else {
    $screencap = $config['static_prefix'].'/'.$lang.'/img/beta4feedback-button.png';
}


$extra_headers = <<<EXTRA_HEADERS
<link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/firefox/beta/4/main.css"  />
EXTRA_HEADERS;

$extra_css .=<<<EXTRA_CSS

    #main-feature {
        padding-top: 0 !important;
    }

    #main-feature h2 {
        padding: 0 !important;
    }

    #firefox-beta #main-feature {
        background:url("{$screenback}") no-repeat scroll 300px 60px transparent !important;
    }

    #beta-install ul.download-firefox li a.download-link, ul.download-firefox li a.download-link:hover {
        font-size:100% !important;
    }

    #main-feature ul.download-firefox {
        width:auto !important;
    }

    #main-feature ul.download-firefox em {
        font-size:80% !important;
        font-style:italic !important;
    }


    html[lang='it'] #main-feature h3 {
        font-size:230% !important;
    }

    html[lang='ar'] #side-menu {
        font-size:90%;
    }

    html[lang='ar'] #firefox-beta .footnote p {
        text-align:justify;
    }

EXTRA_CSS;

// RTL support
if(in_array($lang, array('ar', 'fa', 'he'))) {
    $textdir = 'rtl';
    $extra_css .=<<<EXTRA_CSS

    #firefox-beta #main-feature {
        margin: 0 20px 0 210px !important;
        background:url("{$screenback}") no-repeat scroll 0px 60px transparent !important;
    }

    #main-feature p {
        margin-left: auto !important;
        margin-right:auto !important;
    }

    .sub-feature  {
        float:right !important;
    }

    #beta-share {
        margin-right:auto !important;
        margin-left:28px !important;
        right:28px;
    }

    #beta-sub-features .sub-feature h3 {
        margin:0 35px 10px 0 !important;
    }

    ul#bubbles li {
        background:url("/img/firefox/beta/4/bubbles.png") repeat-x scroll 0 200px transparent !important;
        float:right !important;
    }

    ul#bubbles li.second {
        float:left !important;
    }

    .sub-feature p {
        margin-right:auto !important;
        margin-left:15px !important;
    }

    #beta-sub-features  {
        background:url("/img/firefox/beta/4/sub-feature-background-rtl.png") no-repeat scroll -1px 0 transparent !important;
    }

    ul.download-firefox  {
        right:auto;
        margin:8px 0 0 10px !important;
        width:auto !important;
    }

    a.download-link {
        padding-right:30px !important;
    }

    a.download-link span {
        margin-right:50px !important;
    }

    .download-other, ul.download-firefox em {
        text-align: right !important;
    }

EXTRA_CSS;
}

// call an extension of product details that will be used for Firefox 4 beta
require "{$config['file_root']}/includes/l10n/firefox-links-l10n.class.php";

$firefoxDetailsl10n = new firefoxDetailsL10n();
$firefoxDetailsl10n -> download_base_url_transition = "/$lang/download/";
$firefoxDetailsl10n -> has_transition_download_page = $betaTransitionPage;

if(!isset($firefoxDetails->primary_builds[$lang][LATEST_FIREFOX_DEVEL_VERSION])
   && !isset($firefoxDetails->beta_builds[$lang][LATEST_FIREFOX_DEVEL_VERSION])) {
    $dl_lang = 'en-US';
    $str     = $download_link_text.' <br/><em>'.___('(in English)').'</em>';
} else {
    $dl_lang = $lang;
    $str = $download_link_text;
}

$options = array(
    'ancillary_links' => false,
    'devel_version'   => true,
    'bouncer_js'      => true,

);

$options['download_product']         = $str;
$options['layout']                   = 'linksonly';
$options['download_parent_override'] = 'main-feature';
$download_link_1  = '<script type="text/javascript" src="'.$config['static_prefix'].'/js/download.js"></script>';

if ($options['bouncer_js']) {
    $download_link_1 .= '<script type="text/javascript" src="'.$config['static_prefix'].'/js/download.old.js"></script>';
}

$download_link_1  .= '<noscript>
<style tyle="text.css">

.nojs li.linksonly {
    display:none !important
}

ul.download-firefox {
    margin-left: 2em;
}

ul.download-firefox li a.download-link, ul.download-firefox li a.download-link:hover {
    background: none;
    color: #447BC4;
    font-size: inherit;
    height: inherit;
    margin-bottom: inherit;
    margin-left: inherit;
    margin-top: 1em;
    padding: inherit;
}

.download-other {
    margin-top: 1em;
}

</style>


</noscript>';


$download_link_1 .= $firefoxDetailsl10n -> getDevelVersionForLocale($dl_lang, $options);


$options['product']                  = 'firefox';
$options['download_product']         = ___('Free Download');
$options['layout']                   = 'betabox';
$options['download_parent_override'] = 'beta-install';
$pricacy_policy                      = ___('Privacy Policy');
$others                              = ___('Other Systems and Languages');
$download_link_2   = $firefoxDetailsl10n -> getDevelVersionForLocale($dl_lang, $options);
$download_link_2  .='<div class="download-other"><span class="other"><a href="/'.$lang.'/legal/privacy/">'.$pricacy_policy.'</a> <br/> <a href="/en-US/firefox/all-beta.html">'.$others.'</a></span></div>';





require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
