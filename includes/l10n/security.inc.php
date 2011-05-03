<?php

$body_id        = 'security';
$extra_headers .= <<<EXTRA_HEADERS
<link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/security.css" media="screen" />
<style>
#main-feature h2 {
    width: 65%;
}
</style>
EXTRA_HEADERS;

// dl box
include_once $config['file_root'].'/includes/l10n/dlbox.inc.php';

require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
