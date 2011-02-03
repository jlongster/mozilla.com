<?php

$body_class = 'locale-'.$lang;

if(!isset($extra_headers)) { $extra_headers=''; }

$extra_headers .= <<<EXTRA_HEADERS

      <link rel="stylesheet" type="text/css" href="/style/tignish/mobile-later.css" media="screen" />
      <script type="text/javascript" src="/js/mobile-desktop.js"></script>
      <style type="text/css">
        #mobile-faq #q26, #mobile-faq #q26 + dd
        {
            display:none;
        }

        #mobile-faq.locale-en-GB #q26, #mobile-faq.locale-en-GB #q26 + dd
        {
            display:auto;
        }
        
        #mobile-developers #main-feature h2
        {
            font-size:300% !important;
            margin:0 380px 0 35px !important;
        }
        
        #mobile-developers #main-feature p
        {
            font-size:160% !important;
        }

      </style>

EXTRA_HEADERS;

if(isset($meta_description)) {
$extra_headers .= <<<EXTRA_HEADERS
    <meta name="description" content="{$meta_description}" />
EXTRA_HEADERS;
}






// Build our dynamic header

$page_title     = empty($page_title)    ? 'Mozilla.com' : $page_title;
$textdir        = empty($textdir)       ? 'ltr'         : $textdir;
$extra_headers  = empty($extra_headers) ? ''            : $extra_headers;
$extra_feature  = empty($extra_feature) ? ''            : $extra_feature;

$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE html>

<html lang="{$lang}" dir="{$textdir}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>{$page_title}</title>

        <script type="text/javascript" src="/js/util.js"></script>
        <link rel="stylesheet" type="text/css" href="/includes/yui/2.5.1/reset-fonts-grids/reset-fonts-grids.css" />
        <link rel="stylesheet" type="text/css" href="/includes/yui/2.5.1/menu/assets/skins/sam/menu.css" />
        <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/template.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/content.css" media="screen" />
        <script type="text/javascript" src="/includes/yui/2.5.1/yahoo-dom-event/yahoo-dom-event.js"></script>
        <script type="text/javascript" src="/includes/yui/2.5.1/container/container_core-min.js"></script>
        <script type="text/javascript" src="/js/mozilla-menu.js"></script>
        <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/portal-page.css" media="screen" />

    {$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class} portal-page">

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

        echo $dynamic_header;

        unset($dynamic_header);

        unset($dynamic_top_menu);
?>