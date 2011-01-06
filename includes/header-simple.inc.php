<?php
    // Build our dynamic header


    $page_title    = empty($page_title)    ? 'Mozilla.com' : $page_title;
    $textdir       = empty($textdir)       ? 'ltr'         : $textdir;
    $extra_headers = empty($extra_headers) ? ''            : $extra_headers;
    $extra_feature  = empty($extra_feature) ? ''           : $extra_feature;


$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE HTML>
<html xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="og:image" content="{$config['static_prefix']}/img/firefox-100.jpg">

    <title>{$page_title}</title>
    <script type="text/javascript" src="/js/util.js"></script>
    <link rel="stylesheet" type="text/css" href="/includes/yui/2.5.1/reset-fonts-grids/reset-fonts-grids.css" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/template.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/content.css" media="screen" />
    <script type="text/javascript" src="/includes/yui/2.5.1/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="/includes/yui/2.5.1/container/container_core-min.js"></script>
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

echo $dynamic_header;
