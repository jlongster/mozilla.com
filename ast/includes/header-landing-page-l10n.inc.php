<?php

        // Include the global header.  All locales will include this.
        require "{$config['file_root']}/includes/header-landing-page-l10n.inc.php";

        // Built dynamically in the global header now, to provide consistency across
        // pages.
        echo $dynamic_header;

        unset($dynamic_header);

        unset($dynamic_top_menu);

?>
