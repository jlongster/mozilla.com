<?php

// Generate the language links to go on the bottom of each page
$lang_list = getLangLinksSelect();

$current_year = date('Y');

$extra_footers = empty($extra_footers) ? '' : $extra_footers;

$latest_firefox_version = LATEST_FIREFOX_VERSION;

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

$dynamic_footer = <<<DYNAMIC_FOOTER

</div><!-- end #doc -->
</div><!-- end #wrapper -->

	<!-- start #footer -->
	<div id="sub-footer">
		<div id="sub-footer-contents">
		<ul>
			<li id="footer-connect">
                          <a href="/{$lang}/firefox/connect/" 
                             onclick="dcsMultiTrack('DCS.dcsuri', '/{$lang}/firefox/connect/', 'WT.ti', 'Connect');">
                            More Ways to Connect
                          </a>
                        </li>
		</ul>
		<p id="sub-footer-newsletter">
			<span class="intro">Want us to keep in touch?</span>
			<a href="/{$lang}/newsletter/" 
                           onclick="dcsMultiTrack('DCS.dcsuri', '/{$lang}/newsletter/', 'WT.ti', 'Newsletter');">
                          Get Monthly News <span>»</span>
                        </a>
		</p>
		</div>
	</div>
	<div id="footer">
	<div id="footer-contents" role="contentinfo">

		<div id="footer-right">

		<form id="lang_form" dir="ltr" method="get"><div>
			<label for="flang">{$l10n->get('Other Languages')}</label>
			{$lang_list}
			<noscript>
				<div><input type="submit" id="lang_submit" value="{$l10n->get('Go')}" /></div>
			</noscript>
		</div></form>

		</div>

		<h3 id="footer-logo"><a href="/{$lang}/firefox/" title="{$l10n->get('Back to home page')}">{$l10n->get('Firefox')}</a></h3>

		{$dynamic_bottom_menu}

		<div id="copyright">
			<p id="footer-links"><a href="/{$lang}/privacy-policy.html">{$l10n->get('Privacy Policy')}</a> &nbsp;|&nbsp; 
			<a href="/{$lang}/about/legal.html">{$l10n->get('Legal Notices')}</a> &nbsp;|&nbsp;
                        <a href="/{$lang}/legal/fraud-report/index.html">{$l10n->get('Report Trademark Abuse')}</a></p>
			<p>Except where otherwise <a href="/{$lang}/about/legal.html#site">noted</a>, content on this site is licensed under the <br /><a href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.</p>
		</div>

	</div>
	</div>
	<!-- end #footer -->
    {$stats_js}
	{$extra_footers}

</body>
</html>
DYNAMIC_FOOTER;

?>
