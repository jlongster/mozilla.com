<?php

if ($lang == 'de') {
    $extra_footer_links = '&nbsp;|&nbsp;<a href="'.$host_l10n.'/impressum/">Impressum</a> &nbsp;|&nbsp;<a href="'.$host_l10n.'/newsletter/">Mozilla-Newsletter</a>';
    // deactivate temporarilly newsletter, see bug 654066
    $extra_footer_links = '&nbsp;|&nbsp;<a href="'.$host_l10n.'/impressum/">Impressum</a>';
}

// no webstats on 404 page
if (isset($_404) && $_404 == true) {
    $disable_js_stats = true;
}

$current_year       = date('Y');
$extra_footer_links = empty($extra_footer_links) ? '' : $extra_footer_links;
$creative_commons   = sprintf(___('Except where otherwise <a href="%s">noted</a>, content on this site is licensed under the <br /><a href="%s">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.'),"/$lang/about/legal.html#site", 'http://creativecommons.org/licenses/by-sa/3.0/');

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

ob_start();


$meta_newsletter = <<<META
    <script src="{$config['static_prefix']}/includes/min/min.js?g=js&amp;2011-06-21"></script>
<style>


#footer {
    width:70% !important;
    padding:20px 15% !important;
}


#footer #copyright p {
    max-width:780px !important;
}

#fonter-contents {
    width:auto !important;
}

#sub-footer {
    clear:none !important;
    float: left !important;
    margin-top: -181px !important;
    background:none !important;
    margin-left:100px !important;
}

</style>
META;

echo $meta_newsletter;

echo '<div id="sub-footer">
        <div id="sub-footer-contents">
            <div id="sub-footer-newsletter">';


include "{$config['file_root']}/includes/l10n/newsletter-block.inc.php";

echo '            </div>
            </div>
        </div>';

$newsletter_form = ob_get_contents();
ob_end_clean();

if(!in_array($lang, array('fr'))) {
    $newsletter_form = '';
}

$dynamic_footer = <<<DYNAMIC_FOOTER

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->



    <!-- start #footer -->
    <div id="footer">

        <div id="footer-contents">
            <div id="copyright">
                <p id="footer-links"><a href="{$host_l10n}/" id="footer-logo" title="{$l10n->get('Back to home page')}"><img src="{$config['static_prefix']}/img/tignish/template/mozilla-logo.png" height="56" width="145" alt="Mozilla" /></a><a href="{$config['url_scheme']}://{$config['server_name']}/{$lang}/privacy-policy.html">{$l10n->get('Privacy Policy')}</a> &nbsp;|&nbsp;
                <a href="{$host_l10n}/about/legal.html">{$l10n->get('Legal Notices')}</a> &nbsp;|&nbsp;
                <a href="{$host_l10n}/legal/fraud-report/index.html">{$l10n->get('Report Trademark Abuse')}</a>{$extra_footer_links}</p>
                <p>{$creative_commons}</p>

            </div>
        </div>

        {$newsletter_form}

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
