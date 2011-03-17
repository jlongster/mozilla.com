<?php
$body_id    = 'firefox-features';
$html5      = true;

/*
 * format numbers according to national conventions ans localizers preferences
 *
 */

function localeNumberFormat($val) {
    if(UI_LANG == 'en') {
        $val = number_format($val, 0, '.', ',');
    } else {
        $val = number_format($val, 0, ',', '.');
    }
    return $val;
}

function buildPlatformImageL10n($filename, $alt, $width = null, $height = null,
                                $class = null, $platforms = array('mac')) {
        if($platforms == null) { $platforms = array('');}
        $valid_platforms = array('mac', 'linux', 'xp');
        $platforms = array_intersect($valid_platforms, $platforms);
        // reindex array, we expect ordinal indexing later
        $platforms = array_values($platforms);

        // maps platforms to JavaScript boolean expressions
        $platform_conditional = array(
                'mac'     => 'gPlatform == PLATFORM_MACOSX',
                'linux'   => 'gPlatform == PLATFORM_LINUX',
                'xp'      => '!gPlatformVista',
        );

        $filename = minimizeEntities($filename);
        $filename = escapeForJavaScript($filename);

        $alt = minimizeEntities($alt);
        $alt = escapeForJavaScript($alt);
        $alt = str_replace('%', '%%', $alt);

        // build image tag template
        $image_template = '<img src="%s" alt="' . $alt .'"';
        if (is_int($width)) {
                $image_template.= ' width="' . $width . '"';
        }
        if (is_int($height)) {
                $image_template.= ' height="' . $height . '"';
        }
        if (is_string($class)) {
                $class = minimizeEntities($class);
                $class = escapeForJavaScript($class);
                $class = str_replace('%', '%%', $class);
                $image_template.= ' class="' . $class . '"';
        }
        $image_template.= ' />';

        // build platform-specific image tags
        $filename_exp = explode('.', $filename);
        $extension = array_pop($filename_exp);
        $base = implode('.', $filename_exp);
        foreach ($platforms as $platform) {
            $platform_filename = $base . '-' . $platform . '.' . $extension;
            // if a linux or mac localized screenshot does not exist, we want to fallback to en-US screenshot
            if(!file_exists($_SERVER['DOCUMENT_ROOT'].$platform_filename)) {
                $platform_filename = str_replace('/'.UI_LANG.'/', '/en-US/', $platform_filename);
            }

            $platform_image[$platform] = sprintf($image_template, $platform_filename);
        }

        // if a windows localized screenshot does not exist, we want to fallback to en-US screenshot
        if(!file_exists($_SERVER['DOCUMENT_ROOT'].$filename)) {
            $filename = str_replace('/'.UI_LANG.'/', '/en-US/', $filename);
        }
        $default_image = sprintf($image_template, $filename);

        ob_start();

        if (count($platforms) === 0) {
                echo $default_image;
        } else {
                echo '<script type="text/javascript">// <![CDATA[', "\n";

                foreach ($platforms as $index => $platform) {
                        if ($index == 0) {
                                printf("if (%s) {\n\tdocument.write('%s');\n",
                                        $platform_conditional[$platform],
                                        $platform_image[$platform]);
                        } else {
                                printf("} else if (%s) {\n\tdocument.write('%s');\n",
                                        $platform_conditional[$platform],
                                        $platform_image[$platform]);
                        }
                }

                printf("} else {\n\tdocument.write('%s');\n}\n",
                        $default_image);

                echo '// ]]></script><noscript><div style="display: inline;">',
                        $default_image,
                        "</div></noscript>";
        }

        return ob_get_clean();
}


if(!isset($extra_headers)) { $extra_headers = ''; }
if(!isset($extra_css))     { $extra_css     = ''; }

// dl box
include_once $config['file_root'].'/includes/l10n/dlbox.inc.php';

$localeImgFolder= '/img/screenshots/'.$lang.'/firefox4/features/';

$logo36 = '/img/l10n/chart-firefox-3.6.png';
$logo4  = '/img/l10n/chart-firefox-4.png';
$miliseconds = (isset($miliseconds)) ? $miliseconds : 'ms';
$value[1]   = localeNumberFormat(14293).$miliseconds;
$value[2]   = localeNumberFormat(5072).$miliseconds;
$value[3]   = localeNumberFormat(620).$miliseconds;
$value[4]   = localeNumberFormat(206).$miliseconds;
$value[5]   = localeNumberFormat(733);
$value[6]   = localeNumberFormat(5189);
$comment[1] = (isset($comment[1])) ? $comment[1] : 'Fx4 - more than 3.5x faster!';
$comment[2] = (isset($comment[2])) ? $comment[2] : 'Fx4 - more than 3x faster!';
$comment[3] = (isset($comment[3])) ? $comment[3] : 'Fx4 - more than 6x faster!';

$performancechart = <<<CHART
<table id="performance-chart">
    <tbody>
        <tr>
            <td></td> <th>Kraken</th>
        </tr>
        <tr class="kraken-36">
            <th><img src="{$logo36}" alt="Firefox 3.6"></th> <td><span style="width: 100%;">&nbsp;$value[1]&nbsp;&nbsp;</span></td>
        </tr>
        <tr class="kraken-4 winner">
            <th><img src="{$logo4}" alt="Firefox 4"></th> <td><span style="width: 35.5%;">&nbsp;<em>$value[2]</em>&nbsp;&nbsp;</span></td>
        </tr>
        <tr class="note">
            <td></td><td>{$comment[1]}</td>
        </tr>
        <tr>
            <td></td> <th>Sunspider</th>
        </tr>
        <tr class="sunspider-36">
            <th><img src="{$logo36}" alt="Firefox 3.6"></th> <td><span style="width: 100%;">&nbsp;$value[3]&nbsp;&nbsp;</span></td>
        </tr>
        <tr class="sunspider-4 winner">
            <th><img src="{$logo4}" alt="Firefox 4"></th> <td><span style="width: 33.2%;">&nbsp;<em>$value[4]</em>&nbsp;&nbsp;</span></td>
        </tr>
        <tr class="note">
            <td></td><td>{$comment[2]}</td>
        </tr>
        <tr>
            <td></td> <th>v8</th>
        </tr>
        <tr class="v8-36">
            <th><img src="{$logo36}" alt="Firefox 3.6"></th> <td><span style="width: 14.1%;">&nbsp;$value[5]&nbsp;</span></td>
        </tr>
        <tr class="v8-4 winner">
            <th><img src="{$logo4}" alt="Firefox 4"></th> <td><span style="width: 100%;">&nbsp;<em>$value[6]</em>&nbsp;&nbsp;</span></td>
        </tr>
        <tr class="note">
            <td></td><td>{$comment[3]}</td>
        </tr>
    </tbody>
  </table>

CHART;


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
$link[3]  = '/https://addons.mozilla.org/'.UI_LANG.'/firefox/browse/type:4';
$link[4]  = 'http://www.mozilla.com/'.UI_LANG.'/plugincheck/#what-plugin';
$link[5]  = 'http://www.mozilla.com/'.UI_LANG.'/firefox/performance/';
$link[6]  = 'http://www.mozilla.com/'.UI_LANG.'/plugincheck/';
$link[7]  = '/'.UI_LANG.'/firefox/security/';
$link[8]  = '/'.UI_LANG.'/firefox/customize/';
$link[9]  = 'https://addons.mozilla.org/'.UI_LANG.'/firefox/';
$link[10] = '';
$link[11] = '';
$link[12] = '';
$link[13] = '';
$link[14] = 'http://www.mozilla.com/en-US/firefox/all.html';
$link[15] = 'http://rockyourfirefox.com/';

$return   = ___('Return to top');

$fx4file = $config['file_root'].'/'.UI_LANG.'/firefox/features/fx4.inc.html';

$fx_dl_box = $downloadbox;

$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/l10n/features.css" media="screen" />
    <script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/js/firefox-features.js"></script>

EXTRA_HEADERS;


require $config['file_root'].'/includes/l10n/header-pages.inc.php';

if($fx4released || $config['server_name'] != 'www.mozilla.com') {
    require_once $fx4file;
}

require $config['file_root'].'/includes/l10n/footer-pages.inc.php';
?>
