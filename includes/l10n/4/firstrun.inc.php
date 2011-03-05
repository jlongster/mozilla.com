<?php

$body_id        = 'firstrun';
$html5          = true;
$fallback       = true;
$aboutlink      = '';
$logo           = '<h2><img src="/img/covehead/firefox/background-firefox-download.png" alt="Firefox" /></h2>';
$headerfile     = $config['file_root'].'/includes/l10n/4/header.inc.php';
$contentfile    = $config['file_root'].'/'.$lang.'/firefox/4/firstrun/content1.inc.html';
$footerfile     = $config['file_root'].'/includes/l10n/4/footer.inc.php';
$fallbackfile   = $config['file_root'].'/'.$lang.'/firefox/4/firstrun/fallback.inc.html';
$line           = '<br>line : '.__LINE__.'<br>'; //debug


if ($fallback) {
    if (file_exists($fallbackfile)) {
        $headerfile = $config['file_root'].'/includes/l10n/4/firstrun-fallback-header.inc.php';
        $footerfile = $config['file_root'].'/includes/l10n/4/firstrun-fallback-footer.inc.php';
        include_once $config['file_root'].'/includes/l10n/4/firstrun-fallback.inc.php';
        include_once $headerfile;
        include_once $fallbackfile;
        include_once $footerfile;
        exit;
    }
}

// we start here the normal page in non-fallback situation
require_once $headerfile;
echo $logo;
include_once $contentfile;
include_once $footerfile;
?>
