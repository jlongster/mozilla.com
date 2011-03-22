<?php

$page_title    = empty($page_title)    ? 'Mozilla.com' : $page_title;
$textdir       = empty($textdir)       ? 'ltr'         : $textdir;
$extra_headers = empty($extra_headers) ? ''            : $extra_headers;
$breadcrumbs   = empty($breadcrumbs)   ? array()       : $breadcrumbs;
$body_class    = !isset($body_class)   ? ''            : $body_class;
$_hits_per_page    = !isset($_hits_per_page)   ? ''    : $_hits_per_page;
$_hits_per_site    = !isset($_hits_per_site)   ? ''    : $_hits_per_site;

$default_head_scripts = <<<HEAD_SCRIPTS
    <script src="{$config['static_prefix']}/includes/min/min.js?g=js&up"></script>
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

$default_styles = <<<STYLES
    <link href="{$config['static_prefix']}/includes/min/min.css?g=css&up" rel="stylesheet">
STYLES;

$head_scripts = empty($head_scripts) ? $default_head_scripts : $head_scripts;
$fonts        = empty($fonts)        ? $default_fonts        : $fonts;
$styles       = empty($styles)       ? $default_styles       : $styles;


$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE HTML>
<html lang="{$lang}" dir="{$textdir}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1024">
    <title>{$page_title}</title>

  <meta name="og:image" content="{$config['static_prefix']}/img/firefox-100.jpg">

{$fonts}
{$styles}
{$head_scripts}
{$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class}">

<script>// <![CDATA[
// add classes to body to indicate browser version and JavaScript availabiliy
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

<noscript><div id="no-js-feature"></div></noscript>

<div id="wrapper">
<div id="doc">

    <div id="nav-access">
        <a href="#nav-main">{$l10n->get('skip to Navigation')}</a>
        <a href="#lang_form">{$l10n->get('switch language')}</a>
    </div>

	<!-- start #header -->
	<div id="header">
		<div>
		<h1><a href="/{$lang}/firefox/" title="{$l10n->get('Back to home page')}">{$l10n->get('Mozilla Firefox')}</a></h1>
		<a href="http://www.mozilla.org/" class="mozilla">mozilla</a>
		{$dynamic_top_menu}
		</div>
	</div>
	<!-- end #header -->

    {$dynamic_breadcrumb}
DYNAMIC_HEADER;
