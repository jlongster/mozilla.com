<?php

/* Variables and functions needed only on the mobile developers page */

$body_id = 'mobile-developers';


if(!isset($meta_description)) {$meta_description = '';}
if(!isset($extra_headers)) { $extra_headers=''; }

$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="/style/tignish/mobile-later.css" media="screen" />
EXTRA_HEADERS;

include_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";


?>