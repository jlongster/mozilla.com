<?php

$body_id    = 'firefox-about';
$body_class = 'portal-page locale-'.$lang;

if(!isset($meta_description)) {$meta_description = '';}
if(!isset($extra_headers)) {$extra_headers = '';}


$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/firefox-about.css" media="screen" />

EXTRA_HEADERS;

?>
