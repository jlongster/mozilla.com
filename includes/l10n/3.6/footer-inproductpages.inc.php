<?php

include_once "{$config['file_root']}/{$lang}/includes/l10n/in-product-3.6.inc.html";


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


echo $dynamic_footer;
unset($dynamic_footer);

?>
