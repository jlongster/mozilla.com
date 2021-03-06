<?php

$extra_footers      = empty($extra_footers) ? '' : $extra_footers;
$extra_footer_links = empty($extra_footer_links) ? '' : $extra_footer_links;

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

$inline_js_portal_footer = min_inline_js('js_portal_footer');
if (isset($detect_flash) && $detect_flash == TRUE)
{
    $inline_js_portal_footer .= min_inline_js('detect_flash');
}

$dynamic_footer = <<<DYNAMIC_FOOTER

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    {$stats_js}
    {$extra_footers}
    {$inline_js_portal_footer}
</body>
</html>
DYNAMIC_FOOTER;

if($lang != 'en-US') {
    // only en-US has a dedicated file just to echo the footer
    echo $dynamic_footer;
    unset($dynamic_footer);
}

?>
