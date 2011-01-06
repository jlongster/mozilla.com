<?php

/* Variables and functions needed only on the mobile requirements page */

$body_id = 'mobile-requirements';

include_once "{$config['file_root']}/includes/product-details/mobileDetails.class.php";
$extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="/style/tignish/mobile-later.css" media="screen" />
EXTRA_HEADERS;

?>
