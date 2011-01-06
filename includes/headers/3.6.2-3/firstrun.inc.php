<?php

/**
 * Extra HTML head content for the "First Run" page for Firefox 3.6.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id    = 'firstrun';
$body_class = '';

$extra_headers = <<<EXTRA_HEADERS
    <style type="text/css">
        /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
        @font-face { font-family: 'MetaWebPro-Book'; src: url('/img/fonts/MetaWebPro-Book.woff') format('woff'); }
        @font-face { font-family: 'MetaWebPro-Bold'; src: url('/img/fonts/MetaWebPro-Bold.woff') format('woff'); }
    </style>
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/firefox/3.6/firstrun-page-3.6.2-3.css" media="screen" />
    <script type="text/javascript" src="{$config['static_prefix']}/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="{$config['static_prefix']}/js/mozilla-expanders.js"></script>
    <script type="text/javascript" src="{$config['static_prefix']}/js/mozilla-input-placeholder.js"></script>
EXTRA_HEADERS;

?>
