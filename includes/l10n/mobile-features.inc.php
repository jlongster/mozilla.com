<?php

/* Variables and functions needed only on the customize mobile page */

$body_id    = 'mobile-features';

if(!isset($meta_description)) {$meta_description = '';}
if(!isset($extra_headers)) {$extra_headers = '';}

$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/mobile-features.css" media="screen" />
      <style type="text/css">
        #main-content {
            float: left;
            margin-top:0px;
            width: 700px;
        }
        #content {
            clear: both;
        }

        #sidebar {
            margin-top:90px;
        }

        #sidebar  {
            background: none repeat scroll 0 0 #CCE2F3;
            -moz-border-radius: 10px;
            display: inline;
            float: right;
            margin-right: 5px;
            padding: 0 0 0 40px;
            width: 175px;
        }

        #sidebar h4 {
            margin-top: 10px;
        }

        #main-content .column1, #main-content .column2, #main-content .column3 {
            width: 200px;
        }

        #side-menu h3 , #side-menu span {
            color: auto;
        }

      </style>

EXTRA_HEADERS;

include_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";

?>