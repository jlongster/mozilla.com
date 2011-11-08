<?php

/**
 * Extra HTML head content for the "What's New" page for Firefox 3.6.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// commodity functions for localized pages
require_once $config['file_root'] . '/includes/l10n/toolbox.inc.php';
l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/snippets.lang');


$upgrade = ___('Upgrade now');
$warning = ___('You\'re not on the latest version of Firefox. <a href="%s">Upgrade today</a> to get the best of the Web!');
$warning = str_replace('<a', '<br/><a', $warning);
$warning = strip_tags($warning, '<br>');

$body_class = 'whatsnew-3-0-19';
$body_id = 'out-of-date';

// dl box
include_once $config['file_root'].'/includes/l10n/dlbox.inc.php';


$extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/content.css" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/firefox/out-of-date.css" media="screen" />

EXTRA_HEADERS;

$extra_css = <<<EXTRA_CSS

        /* if javascript is disabled, we should show all download boxes */
    li.os_windows, li.os_osx, li.os_linux {
        display: block;
    }

    ul.os_linux li.os_windows, ul.os_linux li.os_osx {
        display: none;
    }
    ul.os_windows li.os_linux, ul.os_windows li.os_osx {
        display: none;
    }
    ul.os_osx li.os_linux, ul.os_osx li.os_windows {
        display: none;
    }



    /* download box adjustments for locales, get some extra horizontal space */

    a.download-link span.download-content {
        font-size: 17px !important;
        line-heigth: 17px !important;
        padding: 10px 0 0 112px !important;
    }

    a.download-link span.download-title {
        margin-bottom: 3px !important !important;
    }

    .betalocale a.download-link span.download-title {
        margin-bottom: 0 !important !important;
    }

    ul.home-download {
        width: 310px !important;
    }

    .download-other {
        width: 320px !important;
    }


EXTRA_CSS;


// Build our dynamic header

$page_title    = empty($page_title)    ? 'Mozilla.com' : $page_title;
$textdir       = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';
$extra_headers = empty($extra_headers) ? ''            : $extra_headers;
$extra_feature = empty($extra_feature) ? ''            : $extra_feature;
$extra_css     = empty($extra_css)     ? ''            : $extra_css;
$body_class    = empty($body_class)    ? ''            : $body_class;


// inline util.js since it's such a small file it doesn't deserver an http call
ob_start();
include $config['file_root'].'/js/util.js';
$util_js = ob_get_contents();
ob_end_clean();


    $doctype = <<<DOCTYPE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
DOCTYPE;


$dynamic_header = <<<DYNAMIC_HEADER
{$doctype}
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>{$page_title}</title>

    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/template.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/content.css" media="screen" />

    <style type="text/css">
    {$extra_css}
    </style>

    {$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class} locale-{$lang} portal-page">
<script type="text/javascript">// <![CDATA[

{$util_js}

if (document.body.className == '') {
    document.body.className = 'js';
} else {
    document.body.className += ' js';
}

if (gPlatform == 1) {
    document.body.className += ' platform-windows';
} else if (gPlatform == 3 || gPlatform == 4) {
    document.body.className += ' platform-mac';
} else if (gPlatform == 2) {
    document.body.className += ' platform-linux';
}

// ]]></script>

<div id="wrapper">
{$extra_feature}
<div id="doc">


DYNAMIC_HEADER;




echo $dynamic_header;

unset($dynamic_header);
unset($dynamic_top_menu);
unset($util_js);
?>

<div id="main-feature">
    <h2><span id="main-feature-msg"><?=$upgrade?></span></h2>
</div>

<div id="main-content">

    <p id="upgrade-msg"><?=$warning?></p>

    <?=$downloadbox?>

</div>
