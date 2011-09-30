<?php

$default_menu = '<ul class="nav-main" role="navigation">';

if ($body_id == 'report_introduction') {
    $default_menu .= '<li class="current" title=""><em>' . ___('Welcome') . '</em></li>';
} else {
    $default_menu .= '<li title=""><a href="/' . $lang . '/foundation/annualreport/2010/">' . ___('Welcome') . '</a></li>';
}

if ($body_id == 'report_opportunities') {
    $default_menu .= '<li class="current" title=""><em>' . ___('Opportunities') . '</em></li>';
} else {
    $default_menu .= '<li title=""><a href="/' . $lang . '/foundation/annualreport/2010/opportunities/">' . ___('Opportunities') . '</a></li>';
}

if ($body_id == 'report_people') {
    $default_menu .= '<li class="current" title=""><em>' . ___('People') . '</em></li>';
} else {
    $default_menu .= '<li title=""><a href="/' . $lang . '/foundation/annualreport/2010/people/">' . ___('People') . '</a></li>';
}

if ($body_id == 'report_ahead') {
    $default_menu .= '<li class="current" title=""><em>' . ___('Ahead') . '</em></li>';
} else {
    $default_menu .= '<li title=""><a href="/' . $lang . '/foundation/annualreport/2010/ahead/">' . ___('Ahead') . '</a></li>';
}

if ($body_id == 'report_faq') {
    $default_menu .= '<li class="current last" title=""><em>' . ___('FAQ') . '</em></li>';
} else {
    $default_menu .= '<li title="" class="last"><a href="/' . $lang . '/foundation/annualreport/2010/faq/">' . ___('FAQ') . '</a></li>';
}

$default_menu .= '</ul>';

$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE HTML>
<html lang="{$lang}" dir="{$textdir}">
<head>
    <meta charset="utf-8">
    <title>{$page_title}</title>


    <style>
    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }
    </style>

    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/video-player.css" media="screen" />
    <link href="{$config['static_prefix']}/includes/min/min.css?g=css" rel="stylesheet">

    <script src="{$config['static_prefix']}/includes/min/min.js?g=js"></script>
    <script src="/js/mozilla-video-tools.js"></script>

{$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class} locale-{$lang}  {$textdir}">

<div id="wrapper">
{$extra_feature}
<div id="doc">

    <div id="nav-access">
        <a href="#nav-main">{$l10n->get('skip to Navigation')}</a>
        <a href="#switch">{$l10n->get('switch language')}</a>
    </div>

    <header id="branding">
        <div id="nav-mozilla">
            <a href="http://www.mozilla.org/" class="mozilla" title="Visit Mozilla.org">Mozilla</a>
        </div>

        <nav id="site-nav">
            {$default_menu}
        </nav>

        <h1 id="site-title">{$l10n->get('The State of Mozilla <span>Annual Report</span>')}</h1>

    </header>

    <section id="content-main">

DYNAMIC_HEADER;


echo $dynamic_header;
unset($dynamic_header);


