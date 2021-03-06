<?php

// Generate the language links to go on the bottom of each page
$lang_list = getLangLinksSelect();

$current_year = date('Y');

$extra_footers = empty($extra_footers) ? '' : $extra_footers;

$latest_firefox_version = LATEST_FIREFOX_VERSION;

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

?>

</div><!-- end #doc -->
</div><!-- end #wrapper -->

<div class="clear"></div>

	<!-- start #footer -->
	<div id="sub-footer">
		<div id="sub-footer-contents">
                  <h3>Let’s be <span>friends!</span></h3>
                  <ul>
                    <li id="footer-twitter">
                      <a href="http://twitter.com/firefox" 
                         onclick="dcsMultiTrack('DCS.dcssip', 'twitter.com', 'DCS.dcsuri', '/firefox', 'WT.ti', 'Twitter');">
                        Twitter
                      </a>
                    </li>
                    <li id="footer-facebook">
                      <a href="http://facebook.com/Firefox" 
                         onclick="dcsMultiTrack('DCS.dcssip', 'facebook.com', 'DCS.dcsuri', '/Firefox', 'WT.ti', 'Facebook');">
                        Facebook
                      </a>
                    </li>
                    <li id="footer-affiliates">
                      <a href="https://affiliates.mozilla.org/" 
                         onclick="dcsMultiTrack('DCS.dcsuri', 'https://affiliates.mozilla.org/', 'WT.ti', 'Affiliates');">
                       Firefox Affiliates
                      </a>
                    </li>
                  </ul>
		  <div id="sub-footer-newsletter">
<?php 
    if(!$hide_footer_newsletter) {
        $__track_footer = TRUE;
        require "{$config['file_root']}/includes/newsletter.inc.php";
    }
?>
		</div>

                <div class="clear"></div>
		</div>
	</div>
	<div id="footer">
	<div id="footer-contents" role="contentinfo">

		<div id="footer-right">

		<form id="lang_form" dir="ltr" method="get"><div>
			<label for="flang"><?=$l10n->get('Other Languages')?></label>
			<?=$lang_list?>
			<noscript>
				<div><input type="submit" id="lang_submit" value="<?=$l10n->get('Go')?>" /></div>
			</noscript>
		</div></form>

		</div>

		<h3 id="footer-logo"><a href="/<?=$lang?>/firefox/" title="<?=$l10n->get('Back to home page')?>"><?=$l10n->get('Firefox')?></a></h3>

                <?=$dynamic_bottom_menu?>

		<div id="copyright">
			<p id="footer-links"><a href="/<?=$lang?>/privacy-policy.html"><?=$l10n->get('Privacy Policy')?></a> &nbsp;|&nbsp; 
			<a href="/<?=$lang?>/about/legal.html"><?=$l10n->get('Legal Notices')?></a> &nbsp;|&nbsp;
                        <a href="/<?=$lang?>/legal/fraud-report/index.html"><?=$l10n->get('Report Trademark Abuse')?></a></p>
			<p>Except where otherwise <a href="/<?=$lang?>/about/legal.html#site">noted</a>, content on this site is licensed under the <br /><a href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.</p>
		</div>

	</div>
	</div>
	<!-- end #footer -->
    <?=$stats_js?>
	<?=$extra_footers?>

    <script>
    // <![CDATA[

    // Firefox 3.x update notice. Only show for Firefox 3.x, don't show for
    // cousins that say they are Firefox 3.x.
    var isOldVersion = (navigator.userAgent &&
        navigator.userAgent.indexOf('Firefox/3.') !== -1 &&
        navigator.userAgent.indexOf('Camino') === -1 &&
        navigator.userAgent.indexOf('SeaMonkey') === -1);

    if (isOldVersion) {
        var oldOnload = window.onload;
        window.onload = function() {
            var script = document.createElement('script');
            script.src = '<?php echo $config['static_prefix']; ?>/js/update-v3.js';
            document.body.appendChild(script);
            if (typeof oldOnload == 'function') {
                oldOnload();
            }
        }
    }

    // ]]>
    </script>

</body>
</html>
