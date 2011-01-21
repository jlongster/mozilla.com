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

require_once $config['file_root'] . '/includes/min/inline.php';
$inline_css_firstrun = min_inline_css('css_firstrun');

$inline_js_utils = min_inline_js('js_utils');

$head_scripts = " ";
$extra_headers = <<<EXTRA_HEADERS
    <meta name="WT.ad" content="Personas;Addons;Mobile;Newsletter;Twitter;Facebook" />

    {$inline_css_firstrun}
    {$inline_js_utils}
EXTRA_HEADERS;

?>
