<?php

// Include the global header.  All locales will include this.
require "{$config['file_root']}/includes/header-portal-pages.inc.php";

// Built dynamically in the global header now, to provide consistency across
// pages.
echo $dynamic_header;

unset($dynamic_header);

?>
