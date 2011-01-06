<?php
    // Build our dynamic header

    $page_title    = empty($page_title)    ? 'Mozilla.com' : $page_title;
    $textdir       = empty($textdir)       ? 'ltr'         : $textdir;
    $extra_headers = empty($extra_headers) ? ''            : $extra_headers;
    $extra_feature  = empty($extra_feature) ? ''           : $extra_feature;

$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE html>

<html lang="{$lang}" dir="{$textdir}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="og:image" content="{$config['static_prefix']}/img/firefox-100.jpg">

    <title>{$page_title}</title>
    <script src="/js/util.js"></script>
    <link rel="stylesheet" href="/includes/yui/2.5.1/reset-fonts-grids/reset-fonts-grids.css" />
    <link rel="stylesheet" href="{$config['static_prefix']}/style/tignish/template.css" media="screen" />
    <link rel="stylesheet" href="{$config['static_prefix']}/style/tignish/content.css" media="screen" />
    <script src="/includes/yui/2.5.1/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script src="/includes/yui/2.5.1/container/container_core-min.js"></script>
    <link rel="stylesheet" href="{$config['static_prefix']}/style/tignish/portal-page.css" media="screen" />
    <link rel="stylesheet" href="{$config['static_prefix']}/style/tignish/landing-page-l10n.css" media="screen" />
    {$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class} portal-page">
<script>// <![CDATA[
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

    <div id="nav-access">
        <a href="#nav-main">{$l10n->get('skip to Navigation')}</a>
        <a href="#switch">{$l10n->get('switch language')}</a>
    </div>

    <!-- start #header -->
    <div id="header">
        <div>
        <h1><a href="/{$lang}/" title="{$l10n->get('Back to home page')}"><img src="{$config['static_prefix']}/img/tignish/template/mozilla-logo.png" height="56" width="145" alt="Mozilla" /></a></h1>
        <a href="http://www.mozilla.com/en-US/" id="return">{$l10n->get('Visit Mozilla.com (in English)')}</a>
        </div>
        <hr class="hide" />
    </div>
    <!-- end #header -->


DYNAMIC_HEADER;
