<?php

/* Variables and functions needed only on the mobile FAQ page */

$body_id = 'mobile-faq';
$extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/tignish/mobile-later.css" media="screen" />
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/mozilla-expanders.css" media="screen" />
    <script src="{$config['static_prefix']}/js/jquery/jquery.min.js"></script>
    <script src="{$config['static_prefix']}/js/mozilla-expanders.js"></script>
EXTRA_HEADERS;

?>
