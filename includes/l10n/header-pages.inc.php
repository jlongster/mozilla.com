<?php


// Build our dynamic header

$page_title     = empty($page_title)     ? 'mozilla.org' : $page_title;
$extra_headers  = empty($extra_headers)  ? ''            : $extra_headers;
$extra_feature  = empty($extra_feature)  ? ''            : $extra_feature;
$extra_css      = empty($extra_css)      ? ''            : $extra_css;
$body_class     = empty($body_class)     ? ''            : $body_class;
$extra_top_text = empty($extra_top_text) ? ''            : $extra_top_text;
$textdir        = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';


// a few commodity variables that are much easier to use in the template than appending config vars
// when all pages on the site are centralized un controller.inc.php, we can remove those
$host_root = $config['url_scheme'].'://'.$config['server_name'].'/';
$host_l10n = $config['url_scheme'].'://'.$config['server_name'].'/'.$lang;
$host_enUS = $config['url_scheme'].'://'.$config['server_name'].'/en-US';


// RTL support for Mozilla.com
if ($textdir == 'rtl') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
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


// activate newsletter


// inline util.js since it's such a small file it doesn't deserve an HTTP call
ob_start();
include "{$config['file_root']}/js/util.js";
$util_js = ob_get_contents();
ob_end_clean();


if (isset($transitional) && $transitional == true) {
    $doctype = <<<DOCTYPE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
DOCTYPE;
} else {
    $doctype = <<<DOCTYPE
<!DOCTYPE HTML>
<html xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
DOCTYPE;
}


$press_link = "";
if(in_array($lang, array('fr', 'de', 'it', 'pl', 'es-ES', 'en-GB'))) {
    l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/press.lang');
    $press_link = <<<PRESS_LINK
        <li id="nav-main-press"><a href="{$host_l10n}/press/">{$l10n->get('Press')}</a></li>
PRESS_LINK;
}

$mozillalink = "<a class=\"mozilla\" href=\"$host_enUS/\">mozilla</a>";
$newfirefox4menu = <<<NEWMENU
        <!-- start menu #nav-main -->

        <div id="nav-main" role="navigation">
          <ul role="menubar">
            <li id="nav-main-features" class="first"><a href="{$host_l10n}/firefox/features/">{$l10n->get('Features')}</a></li>
            <li id="nav-main-addons"><a href="https://addons.mozilla.org/">{$l10n->get('Add-ons')}</a></li>
            <li id="nav-main-support"><a href="http://support.mozilla.com/">{$l10n->get('Support')}</a></li>
            <li id="nav-main-about"><a href="{$host_l10n}/about/">{$l10n->get('About')}</a></li>
            {$press_link}
          </ul>
        </div>
        <!-- end menu #nav-main -->
NEWMENU;

if(isset($abtest) && $abtest == true) {
    $newfirefox4menu = <<<NEWMENU
        <!-- start menu #nav-main -->

        <div id="nav-main" role="navigation">
          <ul role="menubar">
            <li id="nav-main-features" class="first"><a href="{$host_l10n}/firefox/features/">Ordinateur</a></li>
            <li id="nav-main-features" class="first"><a href="{$host_l10n}/firefox/mobile/">Mobile</a></li>
            <li id="nav-main-addons"><a href="https://addons.mozilla.org/">{$l10n->get('Add-ons')}</a></li>
            <li id="nav-main-support"><a href="http://support.mozilla.com/">{$l10n->get('Support')}</a></li>
            <li id="nav-main-about" class="last"><a href="{$host_l10n}/about/">{$l10n->get('About')}</a></li>
          </ul>
        </div>
        <!-- end menu #nav-main -->
NEWMENU;

}

if(isset($abtest) && $abtest == true && in_array($target, array('AB3', 'new')) ) {
    $newfirefox4menu = <<<NEWMENU
        <!-- start menu #nav-main -->

        <div id="nav-main" role="navigation">

        </div>
        <!-- end menu #nav-main -->
NEWMENU;

}


$extra_css .= <<<META

#sub-footer h3 {
    font-size: 18px;
}

#footer  {
    padding:0 15%;
}

#footer-wrap {
    width:980px;
    margin:auto;
}

#footer-wrap #footer-contents {
    width: 680px;
    margin:0;
    float:left;
}

#sub-footer {
    float: left !important;
    margin-top: -105px !important;
    margin-left: 0 !important;
    background:none !important;
    clear: none !important;
}

#sub-footer #sub-footer-contents {
    width:300px;
}


form {
    margin:0; /* IE7 hack */
    width:300px; /* IE7 hack */
}

#sub-footer #sub-footer-newsletter {
    margin:0;
}

#sub-footer #sub-footer-newsletter {
   _background:none !important; /* IE6 hack */
}


#central h3 {
    background: none !important;
    color: inherit !important;
    font-family: inherit !important;
    font-style: auto !important;
    font-weight: inherit !important;
    height: auto !important;
    padding-bottom: inherit !important;
    padding-top: inherit !important;
    text-align: inherit !important;
    line-height: 1.2em !important;
}


META;





if ($textdir == 'rtl') {
$extra_css .= <<<META

#sub-footer #sub-footer-newsletter {
    float: left !important;
    margin: 0 !important;
    padding: 135px 0 0 0 !important;
    text-align: right !important;
    background: url("/img/template/footer-social.png") no-repeat scroll 70% -412px transparent;
}

#sub-footer {
    background: none repeat scroll 0 0 transparent !important;
    float: left !important;
    margin-left: 0px !important;
}

#footer #copyright {
    padding-right: 0px !important;
    padding-left: 30px !important;
}

#footer #footer-contents {
    float:right;
}

#sub-footer #sub-footer-contents {
    width: inherit !important;
    width: 200px !important;
}

form {
    max-width:300px; /* IE7 hack */
}

#sub-footer-newsletter .email-form .email-open, .email-form .email-open {
    -moz-transform: rotate(-90deg);
}

.email-form .radio-wrapper,
.email-form .form-pane .format-field label {
    float: right;
}

META;
}


$dynamic_header = <<<DYNAMIC_HEADER
{$doctype}
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>{$page_title}</title>

    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/template.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/content.css" media="screen" />
    <script src="{$config['static_prefix']}/includes/min/min.js?g=js&amp;2011-06-21"></script>

    <style type="text/css">

    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }

    html {
        background-color: #33559B;
    }

    #doc {
        min-height:550px;
        margin-bottom:50px;
    }

    #main-feature {
        margin: 0 210px 0 20px;
    }

    #main-feature h2 {
        font-size:45px;
        font-style: normal;
    }

    /* {{{ Header */

    #header {
        margin-bottom:20px;
    }

    #header #return {
        float: right;
        font-size: 116%;
        margin: 8px 20px 0 0;
        text-shadow: 0 0 1px white;
        text-transform: lowercase;
        font-style: italic;
        font-weight: normal;
        color:#A0C8DA;
        font-family:georgia, serif
    }

    #header #return #t2 {
        font-family: arial,sans-serif;
        font-size: 120%;
        font-style: normal;
        font-weight: bold;
        color:white !important;
        font-family:sans-serif
        text-shadow: 0 0 1px white;
    }

    #header a#return:link #t2,
    #header a#return:visited #ext {
        color: #fff;
        font-size:130%:
    }

    #header  a#return #t1, #header  a#return #t3 {
        opacity:0.8;
    }


    #header  a#return #t1 {
        font-size:120% !important;
        font-weight: normal !important;
        text-shadow: none !important;
        -moz-opacity: 1;
        opacity: 1;
    }

    #t3 {
        font-size: 90%;
        font-style: normal;
        font-weight: normal;
        text-shadow: none;
        text-transform: none;
    }

    #header a#return:hover{
        text-decoration:none;
        text-shadow: 1px 1px 20px white;
    }




    /* }}} */
    /* {{{ Footer */



    .portal-page #footer {
        background: #33559B !important;
        min-height: 80px !important;
        padding: 20px 0;
        color:lightgray;
    }

    * html #footer {
        height: 80px !important;
    }


    .portal-page #footer #footer-logo {
        float: left;
        margin: 15px 40px  0 -20px;
        height: 100px;
    }

    #footer #copyright p {
        font-size: 100%;
    }

    #footer-contents {
        text-align: left !important;
    }

    /* }}} */
    /* {{{ Content/Sidebar */


    #sidebar {
        float: left;
        display: inline; /* Fix IE double margin float bug */
        position: relative;
        top: -15px;
        width: 270px;
        margin: 0 30px 0 0;
        font-size: 110%;
    }

    body#fastest  #main-content {
        margin: 65px 45px 0 30px;
    }

    /* }}} */

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

     #download.top-right .download-other {
        max-width: 250px;
    }


    a.download-link span.download-content {
        font-size: 17px;
        line-heigth: 17px;
        padding: 10px 0 0 112px;
    }

    a.download-link span.download-title {
        margin-bottom: 3px !important;
    }

    .betalocale a.download-link span.download-title {
        margin-bottom: 0 !important;
    }

    ul.home-download {
        width: 310px;
    }

    .download-other {
        width: 350px;
    }

    /* per locale fixes */

    body.locale-hy-AM #nav-main {
        font-size:10px;
    }

    {$extra_css}
    </style>


    {$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class} locale-{$lang} portal-page {$textdir}">
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

    <div id="nav-access">
        <a href="#nav-main">{$l10n->get('skip to Navigation')}</a>
        <a href="#switch">{$l10n->get('switch language')}</a>
    </div>

    <!-- start #header -->
    <div id="header">
        <div>
        <h1><a href="{$host_l10n}/" title="{$l10n->get('Back to home page')}">Mozilla</a></h1>

        {$mozillalink}
        {$newfirefox4menu}

        </div>
        <hr class="hide" />
    </div>
    <!-- end #header -->


DYNAMIC_HEADER;

echo $dynamic_header;
echo $extra_top_text;
unset($dynamic_header);
unset($extra_top_text);
unset($dynamic_top_menu);
unset($util_js);
