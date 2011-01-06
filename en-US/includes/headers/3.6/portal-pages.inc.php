<?php

        // Include the global header.  All locales will include this.
        require "{$config['file_root']}/includes/headers/3.6/portal-pages.inc.php";

        // Built dynamically in the global header now, to provide consistency across
        // pages.
        echo $dynamic_header;

        unset($dynamic_header);

        unset($dynamic_top_menu);

?>
