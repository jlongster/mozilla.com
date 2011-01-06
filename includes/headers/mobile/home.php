<?php

/* Variables and functions needed only on the mobile home page */
$body_id = 'mobile';

include_once "{$config['file_root']}/includes/mobile-sms.inc.php";
sms::check_submit();

// Check for $platform URL variable to indicate Windows Mobile version of the page
if (isset($_GET['platform'])) {
    $platform = $_GET['platform'];
} else {
    $platform = null;
}

?>
