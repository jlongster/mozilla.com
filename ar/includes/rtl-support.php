<?php

  // RTL support for Mozilla.com

  // For landing pages, landing-rtl.css needs to be included after rtl.css
  $landing_style = '';
  if (isset($landing_page)) {
    $landing_style = <<<LANDING_STYLE
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/landing-rtl.css" media="screen" />
LANDING_STYLE;
  }

  // Use an RTL-specific CSS
  $extra_headers  = <<<EXTRA_HEADERS
  $extra_headers
  <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/{$lang}/style/tignish/rtl.css" media="screen" />
  $landing_style
EXTRA_HEADERS;

?>