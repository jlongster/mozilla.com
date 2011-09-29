<?php

// RTL support for Mozilla.com mobile pages
if ($textdir == 'rtl') {
    $extra_headers  .= <<<EXTRA_HEADERS
    <style>
    #view-full-site {
        left: 0;
        right: auto !important;
    }
    #firefox-logo {
        background: url("/img/mobile/support/firefox-logo.png") no-repeat scroll 99% center transparent !important;
        padding: 0.5em 100px 0 0 !important;
    }
    </style>


EXTRA_HEADERS;
}

// inline util.js since it's such a small file it doesn't deserver an http call
ob_start();
include "{$config['file_root']}/js/util.js";
$util_js = ob_get_contents();
ob_end_clean();

$visit = str_replace('.com', '.org', ___('Visit Mozilla.com'));

$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE html>
<html lang="{$lang}" dir="{$textdir}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
    <title>{$page_title}</title>

    <style>
    {$extra_css}

    html[lang="el"] * {
        text-transform:none !important;
    }

    #nav-tab a, #nav-tab a:visited {
        font-family: "Trebuchet MS";
        font-weight: bold;
        background:none !important;
        padding:10px 15px !important;
    }
    </style>

    {$extra_headers}
</head>

<body id="{$body_id}" class="">

<div class="outer-wrapper">
<div class="wrapper">

    <div id="header">
      <div class="logo">
        <a href="/en-US/m/" id="mozilla-logo">
          <img src="/img/mobile/m/mobile-logo.png" alt="Mozilla"/>
        </a>
      </div>
      <div class="clear"></div>

    </div>

    <!-- end #header -->

DYNAMIC_HEADER;


echo $dynamic_header;
unset($dynamic_header);
