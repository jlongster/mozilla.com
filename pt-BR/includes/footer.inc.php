<?php
        // Include the global footer.  All locales will include this.
        require "{$config['file_root']}/includes/footer.inc.php";

        // Now built in the global footer for consistency
        echo $dynamic_footer;

        unset($dynamic_footer);
?>

