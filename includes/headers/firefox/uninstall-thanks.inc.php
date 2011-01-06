<?php

/**
 * Extra HTML header content for the "Uninstall Survey" thank-you page
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id    = 'uninstall-thanks';
$body_class = 'portal-page';

$extra_headers = <<<EXTRA_HEADERS
<link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/surveygizmo.css" media="screen" />
EXTRA_HEADERS;

?>
