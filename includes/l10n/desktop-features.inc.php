<?php

$body_id = 'firefox-features';

// dl box
include_once $config['file_root'].'/includes/l10n/dlbox.inc.php';

$localeImgFolder= '/img/screenshots/'.$lang.'/firefox4/features/';

# [Bug 661285] [Fx5LaunchDay] Remove Perf graphs from moz.com and add new content to take its place on the Performance page
$performancechart = '<img src="' . $config['static_prefix'] .'/img/l10n/speed-smaller.jpg" style="margin-left:-130px; display:block;" alt=""/>';

$screenshots = array(
    0  => array(false, 'img/nova2/features/img-placeholder.png'),
    1  => array('screen-awesomebar.png',      'Awesome Bar screenshot',           '450', '160', 'right', array('mac', 'linux')),
    2  => array('screen-tabsontop.png',       'Improved Interface screenshot',    '290', '160', 'right', array('mac', 'linux')),
    3  => array('screen-firefoxbutton.png',   'Firefox Button screenshot',        '290', '160', 'right',        array('linux')),
    4  => array('screen-bookmarks.png',       'Bookmarks Button screenshot',      '290', '160', 'right', array('mac', 'linux')),
    5  => array('screen-reloadstop.png',      'Reload/Stop Button screenshot',    '290', '160', 'right', array('mac', 'linux')),
    6  => array('screen-home.png',            'Home Button screenshot',           '290', '160', 'right', array('mac', 'linux')),
    7  => array('screen-apptab.png',          'App Tabs screenshot',              '290', '160', 'right', array('mac', 'linux')),
    8  => array('screen-switchtotab.png',     'Switch-to-Tab screenshot',         '290', '160', 'right', array('mac', 'linux')),
    9  => array('screen-grouptab.png',        'Tab Groups screenshot',            '290', '224', 'right', array('mac', 'linux')),
    10 => array('screen-sync.png',            'Sync screenshot',                  '290', '160', 'right', array('mac', 'linux')),
    11 => array('screen-search.png',          'Search screenshot',                '290', '160', 'right', array('mac', 'linux')),
    12 => array('screen-1clickbookmarks.png', 'One-Click Bookmarking screenshot', '290',  '40', 'right', array('mac', 'linux')),
    13 => array(false, $performancechart),
    14 => array(false, ''),
    15 => array('screen-websiteid.png',       'Instant Web Site ID screenshot',   '290', '160', 'right', array('mac', 'linux')),
    16 => array('screen-private.png',         'Private Browsing screenshot',      '290',  '93', 'right', array('mac', 'linux')),
    17 => array(false, ''),
    18 => array('screen-updates.png',         'Automated Updates screenshot',     '290', '155', 'right', array('mac', 'linux')),
    19 => array(false , ''),
    20 => array('screen-addons.png',          'Add-ons Manager screenshot',       '600', '215', 'right', array('mac', 'linux')),
    21 => array('screen-personas.png',        'Add-ons Manager screenshot',       '290', '160', 'right', array('mac', 'linux')),
    22 => array(false, ''),
    23 => array(false, ''),
);

foreach($screenshots as $k => $v) {
    if($v[0] == false) {
        $img[$k] = $v[1];
    } else {
        $img[$k]  = buildPlatformImageL10n($localeImgFolder.$v[0], $v[1], $v[2], $v[3], $v[4], $v[5]);
    }
}

$link[1]  = '/'.UI_LANG.'/mobile/sync/';
$link[2]  = '/'.UI_LANG.'/mobile/';
$link[3]  = 'https://addons.mozilla.org/'.UI_LANG.'/firefox/browse/type:4';
$link[4]  = 'http://www.mozilla.com/'.UI_LANG.'/plugincheck/#what-plugin';
$link[5]  = 'http://www.mozilla.com/'.UI_LANG.'/firefox/performance/';
$link[6]  = 'http://www.mozilla.com/'.UI_LANG.'/plugincheck/';
$link[7]  = '/'.UI_LANG.'/firefox/security/';
$link[8]  = '/'.UI_LANG.'/firefox/customize/';
$link[9]  = 'https://addons.mozilla.org/'.UI_LANG.'/firefox/';
$link[10] = 'https://mozillademos.org/demos/dashboard/demo.html';
$link[11] = 'https://developer.mozilla.org/en/svg_in_html_introduction';
$link[12] = 'https://developer.mozilla.org/en/IndexedDB';
$link[13] = '/en-US/firefox/technology/';
$link[14] = '/en-US/firefox/all.html';
$link[15] = 'http://rockyourfirefox.com/';

$return   = ___('Return to top');

$fx_dl_box = $downloadbox;

$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/features.css" media="screen" />
    <script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/js/firefox-features.js"></script>

EXTRA_HEADERS;

$extra_css .= <<<EXTRA_CSS
    #firefox-features #main-feature {
        margin: 0 20px;
    }

    #top-features {
        width: 170px;
    }

    #top-features .top-feature-hover {
        display: none;
        position: absolute;
        bottom: -40px;
        left: -285px;
        padding: 40px 30px 25px;
        width: 219px;
        height: 125px;
        border-radius: 15px;
        -moz-border-radius: 15px;
        background: url(/img/covehead/features/bubble.png);
        _background: url(/img/covehead/features/bubble-256.png); /* IE6 only */
    }

    body.locale-ca #top-features h3 span,
    body.locale-pt #top-features h3 span,
    body.locale-it #top-features h3 span,
    body.locale-el #top-features h3 span,
    body.locale-ru #top-features h3 span,
    body.locale-es-ES #top-features h3 span {
        font-size: 18px;
    }

    body.locale-ro #top-features h3 span {
        font-size: 16px;
    }

EXTRA_CSS;

require_once $config['file_root'].'/includes/l10n/header-pages.inc.php';
echo $fx_dl_box; // download box on top of page
require_once $config['file_root'].'/'.UI_LANG.'/firefox/features/content.inc.html';
require_once $config['file_root'].'/includes/l10n/footer-pages.inc.php';
