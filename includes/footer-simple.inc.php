<?php

$extra_footers      = empty($extra_footers) ? '' : $extra_footers;
$extra_footer_links = empty($extra_footer_links) ? '' : $extra_footer_links;

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

$dynamic_footer = <<<DYNAMIC_FOOTER

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    {$stats_js}
    {$extra_footers}

</body>
</html>
DYNAMIC_FOOTER;

echo $dynamic_footer;

?>
