<?php

  // Remove for now because we've been testing without it and it seems we don't use it
  // and it causes warnings
  //require_once 'wurfl/bootstrap.php';
include_once 'product-details/mobileDetails.class.php';

    // Build our dynamic header

    $page_title    = empty($page_title)         ? 'Mozilla.org'    : $page_title;
    $textdir       = empty($textdir)            ? 'ltr'            : $textdir;
    $extra_headers = empty($extra_headers)      ? ''               : $extra_headers;
    $body_class    = empty($body_class)         ? ''               : $body_class;
    $body_id       = empty($body_id)            ? ''               : $body_id;
    $controls      = empty($controls)           ? ''               : $controls;

    $doctype = <<<DOCTYPE
<!DOCTYPE html>
<html lang="{$lang}" dir="{$textdir}">

DOCTYPE;

$header = <<<HEADER
{$doctype}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
    <title>{$page_title}</title>
    <link href="{$config['static_prefix']}/style/covehead/mobile-m.css" rel="stylesheet" media="all" />
    {$extra_headers}
</head>
<body id="{$body_id}" class="{$body_class}">
{$controls}

<div class="outer-wrapper">
  <div class="wrapper">
    <div id="header">
      <div class="logo">
        <a href="/{$lang}/m/" id="mozilla-logo">
          <img src="{$config['static_prefix']}/img/mobile/m/mobile-logo.png" alt="Mozilla Firefox"/>
        </a>
      </div>
      <div class="clear"></div>
    </div>
HEADER;
