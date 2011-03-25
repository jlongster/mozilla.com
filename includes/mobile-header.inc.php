<?php

  // Not sure what this is, but it breaks the site locally.
  // Remove on launch.
  // require_once 'wurfl/bootstrap.php';

include_once 'product-details/mobileDetails.class.php';

    // Build our dynamic header

    $page_title    = empty($page_title)         ? 'Mozilla.com'    : $page_title;
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
    <link href="{$config['static_prefix']}/style/tignish/mobile-m.css" rel="stylesheet" media="all" />
    {$extra_headers}
</head>
<body id="{$body_id}" class="{$body_class}">
{$controls}
<div id="menu" class="closed">
  <ul>
    <li><a href="#">Mozilla Firefox</a></li>
    <li><a href="#">Features</a></li>
    <li><a href="#">Desktop</a></li>
    <li><a href="#">Add-ons</a></li>
    <li><a href="#">Support</a></li>
    <li><a href="#">Visit Mozilla</a></li>
  </ul>
</div>

<script type="text/javascript">
    function toggle_menu(tab) {
      var menu = document.getElementById('menu');

      if(menu.className == 'open') {
          menu.className = 'closed';
          tab.className = 'closed';
      }
      else {
          menu.className = 'open';
          tab.className = 'open';
      }
  }
</script>

<div class="wrapper">
  <div id="header">
    <div class="logo">
      <a href="/{$lang}/m/" id="mozilla-logo">
        <img src="{$config['static_prefix']}/img/mobile/m/mobile-logo.png" alt="Mozilla"/>
      </a>
    </div>
    <div id="nav-tab">
      <a href="#" onclick="toggle_menu(this);">menu</a>
    </div>
    <div class="clear"></div>
  </div>
HEADER;
