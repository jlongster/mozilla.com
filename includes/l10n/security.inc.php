<?php

    $body_id    = 'security';

    if(!isset($extra_headers)) {$extra_headers = '';}
    if(!isset($extra_css))     {$extra_css     = '';}

    $extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/security.css" media="screen" />
    <style>
    #main-feature h2 {
        width: 65%;
    }
    </style>
EXTRA_HEADERS;

    include_once $_SERVER['DOCUMENT_ROOT']."/includes/l10n/libs/class.download.php";

    $firefoxDetailsl10n = new firefoxDetailsL10n();

    $fx_dl_box  = "\n".'<!-- generated box -->'."\n";
    $fx_dl_box .= "\n".'<script type="text/javascript">//<![CDATA['."\n";
    $fx_dl_box .= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/js/download.js');
    $fx_dl_box .= "\n".'//]]>></script>'."\n";
    $fx_dl_box .= "\n".'<div id="download" class="top-right">'."\n";
    $fx_dl_box .= $firefoxDetailsl10n->getLocaleBoxHome(localeConvert(UI_LANG), array('layout' => 'smallbox', 'download_parent_override' => 'download'));
    $fx_dl_box .= "\n".'</div>'."\n";
    $fx_dl_box .= "\n".'<!-- end generated box -->'."\n";

    unset($firefoxDetailsl10n);
    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
