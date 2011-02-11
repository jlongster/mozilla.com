<?php

$body_id    = 'firefox-about';

if(!isset($meta_description)) {$meta_description = '';}
if(!isset($extra_headers)) {$extra_headers = '';}


$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/about.css" media="screen" />
    <style>
    #wrapper {
        background: url("/img/covehead/firefox/survey/thanks-background.png") no-repeat scroll 800px 150px transparent;
    }

    #content {
        margin-right: 400px;
        font-size: 16px;
    }

    #main-feature h2 {
        width: 65%;
    }
    </style>
EXTRA_HEADERS;

include_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
