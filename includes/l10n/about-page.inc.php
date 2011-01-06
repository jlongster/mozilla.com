<?php

    $body_id    = 'what-is-mozilla';
    $html5      = true;

    if(!isset($extra_headers)) {$extra_headers = '';}
    if(!isset($extra_css))     {$extra_css     = '';}

    $extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/about.css" media="screen" />
EXTRA_HEADERS;


    $extra_css .= <<<EXTRA_CSS
    #main-content {
        margin:65px 65px 0 30px;
    }

    #what-is-mozilla #main-feature h3 {
        margin-right:515px !important;
    }

EXTRA_CSS;

    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
