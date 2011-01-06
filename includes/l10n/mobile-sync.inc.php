<?php

/* Variables and functions needed only on the weave mobile page */

$body_id = 'mobile-weave';

if(!isset($meta_description)) {$meta_description = '';}
if(!isset($extra_headers)) {$extra_headers = '';}


$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="/style/tignish/mobile-later.css" media="screen" />
      <style type="text/css">
        #mobile-weave #main-content {
            float: left;
        }
        #mobile-weave #main-feature p {
            margin-right: 265px;
        }
        #side-menu span {
            color: #A0C8DA;
        }

        #mobile-weave #sidebar, #firefox-home #sidebar {
            width: 290px;
        }


      </style>

EXTRA_HEADERS;

include_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";

?>