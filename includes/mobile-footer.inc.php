<?php

$extra_footers = empty($extra_footers) ? '' : $extra_footers;

$link1 = !empty($link1) ? $link1 : "<a href='/{$lang}/m/faq.html'>{$l10n->get('FAQ')}</a>";

$footer_content = empty($footer_content) ? '' : $footer_content;

$creative_commons   = sprintf(___('Except where otherwise <a href="%s">noted</a>, content on this site is licensed under the <br /><a href="%s">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.'),"/$lang/about/legal.html#site", 'http://creativecommons.org/licenses/by-sa/3.0/');

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

if($lang=='en-US'):
    $view_full_site_link_footer = '<a href="/' . $lang . '/?mobile_no_redirect=1" class="button secondary">' . $l10n->get("View Full Site") . '</a>';
else:
    $view_full_site_link_footer = '';
endif;

$footer = <<<FOOTER
</div> <!-- end .wrapper -->

<div id="lower">
    <div class="wrapper">

        <div id="footer">
            {$footer_content}
            <ul class="section">
                <li>
                    <a href="/{$lang}/m/privacy.html">{$l10n->get('Privacy Policy')}</a>
                </li>
            </ul>
            <ul id="social">
                <li id="follow-mail"><a href="/{$lang}/newsletter/about_mobile/"><img src="/img/mobile/m/icon-mail.png" alt="E-mail" /></a></li>
                <li id="follow-twitter"><a href="http://twitter.com/mozmobile"><img src="/img/mobile/m/icon-twitter.png" alt="Twitter" /></a></li>
                <li id="follow-facebook"><a href="http://www.facebook.com/firefoxformobile"><img src="/img/mobile/m/icon-facebook.png" alt="Facebook" /></a></li>
            </ul>
            {$view_full_site_link_footer}
            <p>{$creative_commons}</p>
        </div>

    </div> <!-- end .wrapper -->
</div> <!-- end #lower -->


    {$stats_js}
    {$extra_footers}

</body>
</html>
FOOTER;

?>
