<?php

$body_id    = 'firefox-about';

if(!isset($meta_description)) {$meta_description = '';}
if(!isset($extra_headers)) {$extra_headers = '';}


$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/about.css" media="screen" />

EXTRA_HEADERS;

include_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
