<?php

/**
 * Extra HTML header content for the "Geolocation" page
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id    = 'geolocation';
$body_class = 'portal-page';
$extra_headers = <<<EXTRA_HEADERS
<link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/mozilla-expanders.css" media="screen" />
<link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/geolocation.css" media="screen" />
<link rel="stylesheet" href="{$config['static_prefix']}/style/jquery/nyroModal.css" media="screen" />
EXTRA_HEADERS;

?>
