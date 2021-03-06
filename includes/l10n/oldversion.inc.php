<?php

$body_class = 'whatsnew-3-0-19';
$body_id = 'out-of-date';

// dl box
include_once $config['file_root'].'/includes/l10n/dlbox.inc.php';


$extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/firefox/out-of-date.css" media="screen" />

EXTRA_HEADERS;

$extra_css = <<<EXTRA_CSS
    #main-feature h2 {
        line-height: inherit !important;
    }

    #main-feature h3 {
        font-size:40px;
        font-style:normal;
        margin-top:0;
        text-align: center;
    }
    #main-content {
        margin-top:-70px !important;
        padding-top:70px !important;
    }
    #main-feature h2 span {
        text-align: center;
        min-height: 169px;
    }
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
        width: 320px;
    }


EXTRA_CSS;


// Build our dynamic header

$page_title    = empty($page_title)    ? 'Mozilla.com' : $page_title;
$textdir       = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';
$extra_headers = empty($extra_headers) ? ''            : $extra_headers;
$extra_feature = empty($extra_feature) ? ''            : $extra_feature;
$extra_css     = empty($extra_css)     ? ''            : $extra_css;
$body_class    = empty($body_class)    ? ''            : $body_class;


// RTL support for Mozilla.com
if ($textdir == 'rtl') {
    $extra_headers  .= <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/rtl.css" media="screen" />
EXTRA_HEADERS;
}



// inline util.js since it's such a small file it doesn't deserver an http call
ob_start();
include $config['file_root'].'/js/util.js';
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
DOCTYPE;
}

$version = getVersionBySelf();
$version = explode('.', $version);
array_pop($version);
$version = implode('.', $version);

if($version == '3.5') {
// 3.5 tweaks
$str_upgrade = ___('Free Upgrade');
$extra_headers  .= <<<EXTRA_HEADERS
    <style type="text/css">

    #main-feature h2 span {
        visibility:hidden;
        margin-top:-2em;
    }
    #main-feature h2:after {
        content:"{$str_upgrade}";

    }


    #main-feature h3 {
        font-size: 30px;
        padding-left: 150px;
        text-align: left;
    }

    #main-content {
        padding: 35px 100px 35px 150px;
    }

    #main-content p:first-child {
        display:none;
    }

    </style>

EXTRA_HEADERS;

}


$dynamic_header = <<<DYNAMIC_HEADER
{$doctype}
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>{$page_title}</title>

    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/template.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/content.css" media="screen" />

    <style type="text/css">
    {$extra_css}
    </style>

    {$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class} locale-{$lang} portal-page">
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


DYNAMIC_HEADER;




echo $dynamic_header;

unset($dynamic_header);
unset($dynamic_top_menu);
unset($util_js);

?>
