<?php

include_once $config['file_root'].'/includes/l10n/libs/class.download.php';

$dl_box_id   = $dl_box_aurora = $dl_box_beta = 'default_l10n_download_box';
$dl_fallback = false;

// check if we have a locale remapped to another, preserve the download box link
if(isset($dl_lang)) {
    $templang = $dl_lang;
} else {
    $templang = $lang;
}

switch($pageid) {
    case 'firefox-features':
        $dl_box_class   = 'top-right';
        $dl_box_id      = 'download';
        $dl_box_options = array('layout' => 'smallbox', 'download_parent_override' => 'download');
        break;

    case 'oldversion':
        $dl_box_class   = 'home-download';
        $dl_box_id      = 'dl_latest';
        $dl_box_options = array();
        $dl_box_options = array('download_parent_override' => 'main-content', 'wording' => 'Firefox 4');
        $dl_fallback    = true;
        break;

    case 'firefox-channels':
        $dl_box_class   = '';
        $dl_box_id      = 'download'; // stable release id
        $dl_box_aurora  = 'download_aurora_button';
        $dl_box_beta    = 'dl_beta';
        $dl_box_options = array('download_parent_override'  => 'download',
                                'wording'                   => $mz_stable,
                                'channel'                   => 'stable',
                                'layout'                    => 'aurora',
                                'download_product'          => ___('Download'),
                                'ancillary_links'           => true,
                                );
        $dl_box_options_aurora = array('download_parent_override'  => 'download_aurora',
                                'wording'                   => $mz_aurora,
                                'channel'                   => 'aurora',
                                'layout'                    => 'aurora',
                                'download_product'          => ___('Download'),
                                'ancillary_links'           => false,
                                );
        $beta_button        = '<p><span class="download-soon"><span>'.$soon.'</span>'.$getnotified.'</span></p>';
        break;

    case 'firefox':
    default:
        $dl_box_class = 'home-download';
        $dl_box_options = array('wording' => 'Firefox 4');
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
$downloadbox .= "\n".'<div class="'.$dl_box_class.'" id="'.$dl_box_id.'">'."\n";
$downloadbox .= $firefoxDetailsl10n->getLocaleBoxHome(localeConvert($templang), $dl_box_options);
$downloadbox .= "\n".'</div>'."\n";
$downloadbox .= <<<HIDE
    <script type="text/javascript">//<![CDATA[
      // bug 644255, don't tell users to upgrade to fx4 if they
      // are PPC or using any OS X before 10.5

    if(/(PPC|Mac OS X 10.[0-4])/.test(navigator.userAgent)) {
        document.getElementById('{$dl_box_id}').style.display = 'none'; id="'.$dl_box_id.'"
    }

    </script>
HIDE;
$downloadbox .= "\n".'<!-- end generated box -->'."\n";

// the following hack is for Mac 10.4 that we no longer support with Firefox 4, we need another set of 3.6 boxes for those users
// the first set will be hidden client-side by javascript
if($dl_fallback == true) {
    $dl_box_options = array('download_parent_override' => 'dl_fallback', 'wording' => 'Firefox 3.6', 'older_version' => true);
    $downloadbox .= "\n".'<!-- generated box -->'."\n";
    $downloadbox .= "\n".'<div id="dl_fallback" class="'.$dl_box_class.'">'."\n";
    $downloadbox .= $firefoxDetailsl10n->getLocaleBoxHome(localeConvert($templang), $dl_box_options);
    $downloadbox .= "\n".'</div>'."\n";

$downloadbox .= <<<HIDE
    <script type="text/javascript">//<![CDATA[
      // bug 644255, don't tell users to upgrade to fx4 if they
      // are PPC or using any OS X before 10.5

    if(/(PPC|Mac OS X 10.[0-4])/.test(navigator.userAgent)) {
        document.getElementById('dl_latest').style.display = 'none';
    } else {
        document.getElementById('dl_fallback').style.display = 'none';
    }

    </script>
HIDE;
    $downloadbox .= "\n".'<!-- end generated box -->'."\n";
}

$aurora_button  = "\n".'<!-- generated box -->'."\n";
$aurora_button .= "\n".'<script type="text/javascript">//<![CDATA['."\n";
$aurora_button .= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/js/download.js');
$aurora_button .= "\n".'//]]>></script>'."\n";
$aurora_button .= "\n".'<div class="'.$dl_box_class.'" id="'.$dl_box_aurora.'">'."\n";
$aurora_button .= $firefoxDetailsl10n->getLocaleBoxHome(localeConvert($templang), $dl_box_options_aurora);
$aurora_button .= "\n".'</div>'."\n";
$aurora_button .= <<<HIDE
    <script type="text/javascript">//<![CDATA[
      // bug 644255, don't tell users to upgrade to fx4 if they
      // are PPC or using any OS X before 10.5

    if(/(PPC|Mac OS X 10.[0-4])/.test(navigator.userAgent)) {
        document.getElementById('{$dl_box_id}').style.display = 'none'; id="'.$dl_box_id.'"
    }

    </script>
HIDE;
$aurora_button .= "\n".'<!-- end generated box -->'."\n";


unset($firefoxDetailsl10n);
