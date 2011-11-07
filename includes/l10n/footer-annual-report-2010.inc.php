<?php
$lang_list          = getLangLinksSelect(array( 'cs', 'de', 'en-US', 'es-ES', 'fr', 'gl', 'hu', 'it', 'ja', 'nl', 'pl', 'sl', 'sq', 'tr', 'zh-CN', 'zh-TW' ));
$lang_list          = str_replace(' (España)', '', $lang_list);
$lang_list          = str_replace(' (US)', '', $lang_list);
$current_year       = date('Y');
$extra_footers      = empty($extra_footers) ? '' : $extra_footers;
$extra_footer_links = empty($extra_footer_links) ? '' : $extra_footer_links;
$creative_commons   = sprintf(___('Except where otherwise <a href="%s">noted</a>, content on this site is licensed under the <br /><a href="%s">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.'),"/$lang/about/legal.html#site", 'http://creativecommons.org/licenses/by-sa/3.0/');

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";
$dynamic_footer = <<<DYNAMIC_FOOTER

{$navigation}
    </section><!-- end #content-main -->
    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    <footer id="footer">
    <div class="section">

        <div id="copyright">
            <p id="footer-links"><a href="/{$lang}/privacy-policy.html">{$l10n->get('Privacy Policy')}</a> &nbsp;|&nbsp;
            <a href="/{$lang}/about/legal.html">{$l10n->get('Legal Notices')}</a> &nbsp;|&nbsp;
                        <a href="/{$lang}/legal/fraud-report/index.html">{$l10n->get('Report Trademark Abuse')}</a></p>
            <p>{$creative_commons}</p>
        </div>

        <form id="lang_form" class="languages"  dir="{$textdir}" method="get" action="{$host_root}includes/l10n/langswitcher.inc.php"><div>
            <label for="flang">{$l10n->get('switch language')}</label>
            {$lang_list}
            <noscript>
                <div><input type="submit" id="lang_submit" value="{$l10n->get('Go')}" /></div>
            </noscript>
        </div></form>

    </div>
    </footer>
    <!-- end #footer -->
    {$stats_js}
    {$extra_footers}

</body>
</html>
DYNAMIC_FOOTER;


echo $dynamic_footer;

unset($dynamic_footer);
