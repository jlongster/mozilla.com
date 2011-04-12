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

    #main-feature, #content {
        margin-right: 400px;
        font-size: 16px;
    }

    body.rtl #wrapper {
        background: url("/img/covehead/firefox/survey/thanks-background-rtl.png") no-repeat scroll 200px 150px transparent;
    }


    body.rtl #content,
    body.rtl #main-feature
    {
        margin-left: 400px !important;
        margin-right: 20px !important;
    }




    </style>
EXTRA_HEADERS;

include_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";
include_once "{$config['file_root']}/{$lang}/about/content.inc.php";
include_once "{$config['file_root']}/includes/l10n/footerer-pages.inc.php";
?>
