<?php

$extra_footers = empty($extra_footers) ? '' : $extra_footers;
$footer_content = empty($footer_content) ? '' : $footer_content;

$creative_commons   = sprintf(___('Except where otherwise <a href="%s">noted</a>, content on this site is licensed under the <br /><a href="%s">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.'),"/$lang/about/legal.html#site", 'http://creativecommons.org/licenses/by-sa/3.0/');

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

if($lang=='en-US' || c__("View Full Site")):
    $view_full_site_link_footer = '<a href="/' . $lang . '/?mobile_no_redirect=1" class="button secondary">' . $l10n->get("View Full Site") . '</a>';
else:
    $view_full_site_link_footer = '';
endif;

$footer = <<<FOOTER
  </div> <!-- end .wrapper -->
</div> <!-- end .outer-wrapper -->

<div class="lower-bg"></div>

<div id="lower">
    <div class="wrapper">

        <div id="footer">
          {$footer_content}

          <div class="languages">
            <div>Other Languages</div>
            <select name="language">
              <option value="en-US">English (US)</option>
            </select>
          </div>

          {$view_full_site_link_footer}

          <p>{$creative_commons}</p>
        </div>

    </div> <!-- end .wrapper -->
</div> <!-- end #lower -->

    <script type="text/javascript" src="/js/mobile-nav.js"></script>
    {$stats_js}
    {$extra_footers}

</body>
</html>
FOOTER;

?>
