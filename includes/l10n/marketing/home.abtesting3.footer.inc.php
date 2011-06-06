<?php

// Webtrends stats, see bug 556384
require $config['file_root'] . '/includes/js_stats.inc.php';

$dynamic_footer = <<<DYNAMIC_FOOTER

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    <!-- start #footer -->
        <div class="footer-links">
            <a href="{$host_l10n}/firefox/features/">Ordinateur</a>&nbsp;|&nbsp;
            <a href="{$host_l10n}/firefox/mobile/">Mobile</a>&nbsp;|&nbsp;
            <a href="https://addons.mozilla.org/">{$l10n->get('Add-ons')}</a>&nbsp;|&nbsp;
            <a href="http://support.mozilla.com/">{$l10n->get('Support')}</a>&nbsp;|&nbsp;
            <a href="{$host_l10n}/about/">{$l10n->get('About')}</a>
        </div>

    <!-- end #footer -->
    {$stats_js}
    {$extra_footers}

</body>
</html>
DYNAMIC_FOOTER;


echo $dynamic_footer;

unset($dynamic_footer);
?>
