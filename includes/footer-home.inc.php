<?php

$extra_footers = empty($extra_footers) ? '' : $extra_footers;

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

?>

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    <!-- end #footer -->
    <? echo min_inline_js('js_update_v3'); ?>
    <?=$extra_footers?>
    <?=$stats_js?>

</body>
</html>

