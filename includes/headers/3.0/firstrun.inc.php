<?php
/**
 * Extra HTML head content for the "First Run" page for Firefox 3.0.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id    = 'firstrun';
$body_class = '';

if(!isset($extra_feature_text)) {$extra_feature_text = '';}

$extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/firstrun-page.css" media="screen" />
EXTRA_HEADERS;
$extra_feature = <<<EXTRA_FEATURE
<div id="tab-close"><p>{$extra_feature_text}</p></div>
EXTRA_FEATURE;

?>
