<?php

$default_menu = '<ul class="nav-main" role="navigation">';

if ($body_id == 'firefoxflicks-brief') {
    $default_menu .= '<li class="current" title=""><em>' . ___('Creative Brief') . '</em></li>';
} else {
    $default_menu .= '<li title=""><a href="/' . $lang . '/firefoxflicks/brief/">' . ___('Creative Brief') . '</a></li>';
}

if ($body_id == 'firefoxflicks-faq') {
    $default_menu .= '<li class="current last" title=""><em>' . ___('FAQ') . '</em></li>';
} else {
    $default_menu .= '<li title="" class="last"><a href="/' . $lang . '/firefoxflicks/faq/">' . ___('FAQ') . '</a></li>';
}

$default_menu .= '</ul>';

$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/firefoxflicks.css" media="screen" />
EXTRA_HEADERS;


// RTL support for Mozilla.com
if ($textdir == 'rtl') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <style>
        #global-nav, #firefoxflicks #primary #prequel .container,
        #primary .container {
            text-align: right;
        }
        #global-nav h1 {
            float: right;
        }
        .nav-main {
            float: right;
        }
        #intro p {
            text-align: center;
        }
        #prequel h3, #prequel p.intro {
            float: none;
        }
        #footer #copyright {
            padding-right: 0 !important;
            text-align: center !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/rtl.css" media="screen" />
EXTRA_HEADERS;
}

// no italic for Chineses
if ($lang == 'zh-CN' || $lang == 'zh-TW') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/l10n/covehead/chinese-mod.css" media="screen" />
EXTRA_HEADERS;
}

// no uppercasing for Greek
if ($lang == 'el') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/l10n/covehead/greek-mod.css" media="screen" />
EXTRA_HEADERS;
}

$intro_video = <<<INTRO_VIDEO
<div id="intro-video"></div>
INTRO_VIDEO;

$share_twitter  = '<a class="button share_twitter" href="http://twitter.com/#!/FirefoxFlicks">' .
                   ___('Twitter'). '</a>';

$share_facebook = '<a href="http://www.facebook.com/FirefoxFlicks" class="button share_facebook">' .
                  ___('Facebook') . '</a>';

$social = <<<SOCIAL
<section id="social">
    <h3>{$l10n->get('Flicks News')}</h3>
    {$share_twitter}
    {$share_facebook}
</section>
SOCIAL;

$content_title = '<img src="'.$config['static_prefix'].'/img/covehead/firefoxflicks/content-title-en-US.png" ' .
                 'alt="' . ___('Firefox Flicks') . '" />';

$brand_video = <<<BRAND_VIDEO

BRAND_VIDEO;

if ($body_id == 'firefoxflicks') {
    $home_link_open  = '';
    $home_link_close = '';
} else {
    $home_link_open  = '<a href="../">';
    $home_link_close = '</a>';
}

$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml"
      lang="{$lang}"
      dir="{$textdir}">
<head>
    <meta charset="utf-8">
    <title>{$page_title}</title>

    <meta property="og:title" content="{$page_title}"/>
    <meta property="og:type" content="non_profit"/>
    <meta property="og:url" content="{$host_l10n}/firefoxflicks/"/>
    <meta property="og:image" content="http://www.mozilla.org/img/covehead/firefoxflicks/facebook.jpg"/>
    <meta property="og:site_name" content="{$page_title}"/>
    <meta property="og:locale" content="{$fb_locale}" />
    <meta property="og:description"
          content="{$l10n->get("Mozilla presents a global video contest to tell our story.")}"/>
    <meta name="Description"
          content="{$l10n->get("Mozilla presents a global video contest to tell our story.")}"/>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,greek,latin-ext,cyrillic-ext,cyrillic,greek-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

    <link href="{$config['static_prefix']}/includes/min/min.css?g=css" rel="stylesheet">
    <script src="{$config['static_prefix']}/includes/min/min.js?g=js"></script>
<!--[if lte IE 9]>
<script src="{$config['static_prefix']}/js/html5.js"></script>
<![endif]-->
    {$extra_headers}

</head>

<body id="{$body_id}" class="{$body_class} locale-{$lang}  {$textdir}">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/{$fb_locale}/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header>
    <nav id="global-nav">
        <div id="nav-mozilla">
            <a href="http://www.mozilla.org/" class="mozilla">Mozilla</a>
        </div>
        <h1>{$home_link_open}<img src="{$config['static_prefix']}/img/covehead/firefoxflicks/title-en-US.png" height="59" alt="{$l10n->get('Firefox Flicks')}" />{$home_link_close}</h1>
        {$default_menu}
    </nav>
</header>
DYNAMIC_HEADER;


echo $dynamic_header;
unset($dynamic_header);


