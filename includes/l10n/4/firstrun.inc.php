<?php

$body_id          = 'mozilla-com';
$html5            = true;
$disable_js_stats = true;

if(!isset($extra_headers)) {$extra_headers = '';}
if(!isset($extra_css))     {$extra_css     = '';}

$extra_headers .= <<<EXTRA_HEADERS

    </style>
EXTRA_HEADERS;

$aboutlink  = '';
$logo       = '<h2><img src="/img/covehead/firefox/background-firefox-download.png" alt="Firefox" /></h2>';
$footerfile = $config['file_root'].'/includes/l10n/4/footer.inc.php';

require "{$config['file_root']}/includes/l10n/4/header.inc.php";

echo $logo;

$contentfile = $config['file_root'].'/'.$lang.'/firefox/4/firstrun/content1.inc.html';

if (!file_exists($contentfile)) {
    include $config['file_root'].'/en-GB/firefox/4/firstrun/content1.inc.html';
} else {
    include $contentfile;
}

require_once $footerfile;
?>
