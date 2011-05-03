<?php
    $body_id = 'community';

    if(!isset($extra_headers)) {$extra_headers = '';}
    if(!isset($extra_css))     {$extra_css     = '';}

    $extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="/style/covehead/community.css" media="screen" />
    <style>
    #main-feature h2 {
        width: 65%;
    }
    </style>
EXTRA_HEADERS;

    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
