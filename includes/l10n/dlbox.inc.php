<?php

include_once $config['file_root'].'/includes/l10n/class.novadownload.php';

$dl_box_id = '';

// check if we have a locale remapped to another, preserve the download box link
if(isset($dl_lang)) {
    $templang = $dl_lang;
} else {
    $templang = $lang;
}

switch($pageid) {
    case 'firefox-features':
        $dl_box_class   = 'top-right';
        $dl_box_id      = ' id="download"';
        $dl_box_options = array('layout' => 'smallbox', 'download_parent_override' => 'download');
        if($fx4released) {
            $dl_box_options['wording'] = 'Firefox 4';
        }
        break;
    case 'firefox':
    default:
        $dl_box_class = 'home-download';
        $dl_box_options = array();
        if($fx4released) {
            $dl_box_options['wording'] = 'Firefox 4';
        }
        break;
}

$firefoxDetailsl10n = new firefoxDetailsL10n();

// if we don't have builds for a locale yet, let's display an en-US build to avoid php warnings
if(!array_key_exists($templang, $firefoxDetailsl10n->primary_builds) AND !array_key_exists($templang, $firefoxDetailsl10n->beta_builds)) {
    // Download box code for locales
    $templang = 'en-US';
}

if(!isset($firefoxDetailsl10n->primary_builds[$templang][LATEST_FIREFOX_VERSION]) AND !isset($firefoxDetailsl10n->beta_builds[$templang][LATEST_FIREFOX_VERSION])) {
    // Download box code for locales
    $templang = 'en-US';
}


$downloadbox  = "\n".'<!-- generated box -->'."\n";
$downloadbox .= "\n".'<script type="text/javascript">//<![CDATA['."\n";
$downloadbox .= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/js/download.js');
$downloadbox .= "\n".'//]]>></script>'."\n";
$downloadbox .= "\n".'<div class="'.$dl_box_class.'"'.$dl_box_id.'>'."\n";
$downloadbox .= $firefoxDetailsl10n->getLocaleBoxHome(localeConvert($templang), $dl_box_options);
$downloadbox .= "\n".'</div>'."\n";
$downloadbox .= "\n".'<!-- end generated box -->'."\n";

unset($firefoxDetailsl10n);



?>

