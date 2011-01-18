<?php

$body_id    = 'home';
$html5      = true;

if(!isset($meta_description)) {$meta_description = '';}
if(!isset($extra_headers)) {$extra_headers = '';}

$extra_headers .= <<<EXTRA_HEADERS
    <meta name="description" content="{$meta_description}" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/landing-page-l10n.css" media="screen" />

EXTRA_HEADERS;

$templang = $lang;


include_once $_SERVER['DOCUMENT_ROOT']."/includes/l10n/class.novadownload.php";

$firefoxDetailsl10n = new firefoxDetailsL10n();

$downloadbox  = "\n".'<!-- generated box -->'."\n";
$downloadbox .= "\n".'<script type="text/javascript">//<![CDATA['."\n";
$downloadbox .= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/js/download.js');
$downloadbox .= "\n".'//]]>></script>'."\n";
$downloadbox .= "\n".'<div id="home-download">'."\n";
$downloadbox .= $firefoxDetailsl10n->getLocaleBoxHome($lang);
$downloadbox .= "\n".'</div>'."\n";
$downloadbox .= $firefoxDetails->getNoScriptBlockForLocale($lang);
$downloadbox .= "\n".'<!-- end generated box -->'."\n";

unset($firefoxDetailsl10n);




// if we don't have builds for a locale yet, let's display an en-US build to avoid php warnings
/*
if(!array_key_exists($templang, $firefoxDetails->primary_builds) AND !array_key_exists($templang, $firefoxDetails->beta_builds)) {
    // Download box code for locales
    $templang = 'en-US';
    $downloadbox  = '<script type="text/javascript" src="'.$config['static_prefix'].'/js/download.js"></script>';
    $downloadbox .= $firefoxDetails->getDownloadBlockForLocale($templang,  array('ancillary_links' => true, 'download_product' => 'Free Download') );
} else {
    $downloadbox  = '<script type="text/javascript" src="'.$config['static_prefix'].'/js/download.js"></script>';
    $downloadbox .= $firefoxDetails->getDownloadBlockForLocale($lang,  array('ancillary_links' => true, 'download_product' => 'Free Download') );
}
*/

require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
