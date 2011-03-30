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

<div id="menu">
  <ul>
    <li><a href="/m">Mozilla Firefox</a></li>
    <li><a href="/mobile/features/">{$l10n->get('Features')}</a></li>
    <li><a href="/firefox">{$l10n->get('Desktop')}</a></li>
    <li><a href="http://addons.mozilla.org/">{$l10n->get('Add-ons')}</a></li>
    <li><a href="http://support.mozilla.org/">{$l10n->get('Support')}</a></li>
    <li><a href="http://mozilla.org/">{$visit}</a></li>
  </ul>
</div>


<div class="outer-wrapper">
<div class="wrapper">

    <div id="header">
      <div class="logo">
        <a href="/en-US/m/" id="mozilla-logo">
          <img src="/img/mobile/m/mobile-logo.png" alt="Mozilla"/>
        </a>
      </div>
      <div id="nav-tab">
        <a href="#" onclick="toggle_menu(this);" id="arrow">&nbsp;&nbsp;&darr;&nbsp;&nbsp;</a>
      </div>
      <div class="clear"></div>

    </div>

    <!-- end #header -->
<script>

    (function() {
      var menu = document.getElementById('menu');
      var arrow = document.getElementById('arrow');
      var height = menu.offsetHeight;

      function toggle_menu(tab) {
          if(menu.className == 'open') {
              menu.style.marginTop = -height + 'px';
              arrow.innerHTML = '&nbsp;&nbsp;&darr;&nbsp;&nbsp;';
              menu.className = 'closed';
              tab && (tab.className = 'closed');
          }
          else {
              menu.style.marginTop = 0;
              arrow.innerHTML = '&nbsp;&nbsp;&uarr;&nbsp;&nbsp;';
              menu.className = 'open';
              tab && (tab.className = 'open');
          }
      }

      menu.style.marginTop = -height + 'px';
      window.toggle_menu = toggle_menu;
    })();

</script>

DYNAMIC_HEADER;


echo $dynamic_header;
unset($dynamic_header);
