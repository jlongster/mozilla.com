<?php
    // Build our dynamic header

    $page_title    = empty($page_title)     ? 'Mozilla.com' : $page_title;
    $textdir       = empty($textdir)        ? 'ltr'         : $textdir;
    $extra_headers = empty($extra_headers)  ? ''            : $extra_headers;
    $extra_feature  = empty($extra_feature) ? ''            : $extra_feature;
    $body_class    = !isset($body_class)    ? ''            : $body_class;
    $body_id       = !isset($body_id)       ? 'firstrun'    : $body_id;

    require_once $config['file_root'] . '/includes/min/inline.php';

$default_head_scripts = <<<HEAD_SCRIPTS
    <script src="{$config['static_prefix']}/js/util.js"></script>

HEAD_SCRIPTS;

$default_fonts = <<<FONTS
    <style>
    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }
    </style>
FONTS;

$default_styles = '';

$head_scripts = empty($head_scripts) ? $default_head_scripts : $head_scripts;
$fonts = empty($fonts) ? $default_fonts : $fonts;
$styles = empty($styles) ? $default_styles : $styles;

$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE HTML>
<html lang="{$lang}" dir="{$textdir}">
<head>
    <meta charset="utf-8">
    <title>{$page_title}</title>

{$fonts}
{$styles}
{$head_scripts}
    {$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class} locale-{$lang} portal-page">
    <script type="text/javascript">// <![CDATA[
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


