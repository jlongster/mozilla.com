<?php
    // Build our dynamic header

    $page_title    = empty($page_title)    ? 'Mozilla.org' : $page_title;
    $textdir       = empty($textdir)       ? 'ltr'         : $textdir;
    $extra_headers = empty($extra_headers) ? ''            : $extra_headers;
    $dynamic_top_menu = empty($dynamic_top_menu) ? ''            : $dynamic_top_menu;
    $body_class    = !isset($body_class)   ? ''            : $body_class;
    $body_id    = !isset($body_id)   ? ''            : $body_id;

$default_head_scripts = <<<HEAD_SCRIPTS
    <script src="{$config['static_prefix']}/includes/min/min.js?g=js"></script>
<!--[if lte IE 9]>
<script src="{$config['static_prefix']}/js/html5.js"></script>
<![endif]-->
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
	<link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/video-player.css" media="screen" />
    <link href="{$config['static_prefix']}/includes/min/min.css?g=css" rel="stylesheet">
STYLES;

$head_scripts = empty($head_scripts) ? $default_head_scripts : $head_scripts;
$fonts        = empty($fonts)        ? $default_fonts        : $fonts;
$styles       = empty($styles)       ? $default_styles       : $styles;


$default_menu = '<ul class="nav-main" role="navigation">';
if ($body_id == 'report_introduction') $default_menu .= '<li class="current" title=""><em>Welcome</em></li>';
else $default_menu .= '<li title=""><a href="/en-US/foundation/annualreport/2010/">Welcome</a></li>';
if ($body_id == 'report_opportunities') $default_menu .= '<li class="current" title=""><em>Opportunities</em></li>';
else $default_menu .= '<li title=""><a href="/en-US/foundation/annualreport/2010/opportunities/">Opportunities</a></li>';
if ($body_id == 'report_people') $default_menu .= '<li class="current" title=""><em>People</em></li>';
else $default_menu .= '<li title=""><a href="/en-US/foundation/annualreport/2010/people/">People</a></li>';
if ($body_id == 'report_ahead') $default_menu .= '<li class="current" title=""><em>Ahead</em></li>';
else $default_menu .= '<li title=""><a href="/en-US/foundation/annualreport/2010/ahead/">Ahead</a></li>';
if ($body_id == 'report_faq') $default_menu .= '<li class="current last" title=""><em>FAQ</em></li>';
else $default_menu .= '<li title="" class="last"><a href="/en-US/foundation/annualreport/2010/faq/">FAQ</a></li>';
$default_menu .= '</ul>';

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

<body id="{$body_id}" class="{$body_class} locale-{$lang}">

<div id="wrapper">
{$extra_feature}
<div id="doc">

    <div id="nav-access">
        <a href="#nav-main">{$l10n->get('skip to Navigation')}</a>
        <a href="#switch">{$l10n->get('switch language')}</a>
    </div>

    <header id="branding">
        <div id="nav-mozilla">
            <a href="http://www.mozilla.org/" class="mozilla" title="Visit Mozilla.org" rel="external">Mozilla</a>
        </div>

        <nav id="site-nav">
            {$default_menu}
        </nav>

        <h1 id="site-title">The State of Mozilla <span>Annual Report</span></h1>

    </header>



DYNAMIC_HEADER;


