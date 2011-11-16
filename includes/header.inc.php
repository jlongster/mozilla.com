<?php
require_once "{$config['file_root']}/includes/min/inline.php";

$page_title    = empty($page_title)    ? 'Mozilla.org' : $page_title;
$textdir       = empty($textdir)       ? 'ltr'         : $textdir;
$extra_headers = empty($extra_headers) ? ''            : $extra_headers;
$breadcrumbs   = empty($breadcrumbs)   ? array()       : $breadcrumbs;
$body_class    = !isset($body_class)   ? ''            : $body_class;
$_hits_per_page    = !isset($_hits_per_page)   ? ''    : $_hits_per_page;
$_hits_per_site    = !isset($_hits_per_site)   ? ''    : $_hits_per_site;
$hide_footer_newsletter = empty($hide_footer_newsletter) ? FALSE : $hide_footer_newsletter;

if (isset($page_desc)) {
    $meta_desc = '<meta name="Description" content="'.$page_desc.'">';
} else {
    $meta_desc = '';
}

$default_head_scripts = <<<HEAD_SCRIPTS
    <script src="{$config['static_prefix']}/includes/min/min.js?g=js"></script>
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
    <link href="{$config['static_prefix']}/includes/min/min.css?g=css" rel="stylesheet">
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
    {$meta_desc}
{$fonts}
{$styles}
{$head_scripts}
{$extra_headers}
<style>
#download #update-notice { display: none; }

#update-notice {
    background: rgb(20,20,20);
    background: rgba(38, 38, 38, 0.95);
    border-bottom: 2px solid #686868;
    text-shadow: 0 1px #000;
    -moz-text-shadow: 0 1px #000;
    display: none;
    overflow: hidden;
    width: 100%;
    z-index: 99;
    line-height: 1;
}

#update-notice.bottom {
    position: fixed;
    bottom: 0;
}

#update-notice .container {
    text-align: left;
    padding: 15px 10px 15px 140px;
    width: 800px;
    display: inline-block;
    margin: 0 auto;
    background: url({$config['static_prefix']}/img/covehead/firefox/update-creature.png) 0 100% no-repeat;
    position: relative;
}

#update-notice .message {
    float: left;
    width: 600px;
}

#update-notice h2 {
    letter-spacing: normal;
    text-transform: none;
    font-family: inherit;
    font-weight: normal;
    font-size: 18px;
    font-style: normal;
    margin: 0 0 5px 0;
    color: #fff;
}

#update-notice p {
    font-size: 14px;
    color: #ccc;
    margin: 0;
}

#update-notice p.action {
    width: 200px;
    margin: 0;
    text-align: center;
    float: right;
}

#home #update-notice p.action {
    display: none;
}

#update-notice p.action span {
    display: block;
}

#update-notice p.action span a {
    color: #6ba4ff;
}

#update-notice .button {
    display: inline-block;
    padding: 6px 16px 8px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    box-shadow: 0 2px rgba(0, 0, 0, 0.1),
                0 -2px rgba(0, 0, 0, 0.1) inset;
    background:-moz-linear-gradient(top, #84C63C, #489615);
    background-color: #489615;
    color: #fff;
    font-size: 16px;
    font-style: italic;
    text-decoration: none;
    text-shadow: 1px 1px rgba(0,0,0,0.4);
}

#update-notice .close {
    position: absolute;
    top: 12px;
    right: 0;
    background: url(/img/covehead/firefox/update-close.png) 0 0 no-repeat;
    height: 25px;
    width: 25px;
    overflow: hidden;
    text-indent: -1000em;
}

#update-notice .close:hover,
#update-notice .close:focus {
    background-position: -25px 0;
}

a.censor {
    background-image: url({$config['static_prefix']}/img/censored_white.png);
    -moz-transform: rotate(-2deg);
    -webkit-transform: rotate(-2deg);
}

a.censor:hover {
    background-image: url({$config['static_prefix']}/img/censored_blue.png);
}

div#preload { display: none }

</style>
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
		<h1>
                  <a href="/{$lang}/firefox/" title="{$l10n->get('Back to home page')}">{$l10n->get('Mozilla Firefox')}</a>
                </h1>

                <a class="censor" style="width:230px;height:35px;vertical-align:middle;text-align:center;background-color:#000;position:absolute;z-index:5555;top:16px;left:-10px;background-position:center center;background-repeat:no-repeat;" href="http://www.mozilla.org/sopa"></a>

		<a href="http://www.mozilla.org/" class="mozilla">mozilla</a>
		{$dynamic_top_menu}
		</div>
	</div>
	<!-- end #header -->

        <div id="preload">
          <img src="{$config['static_prefix']}/img/censored_blue.png" width="1" height="1" />
        </div>

    {$dynamic_breadcrumb}
DYNAMIC_HEADER;
