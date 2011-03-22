<?php

/**
 * Extra HTML head content for the "What's New" page for Firefox 3.6.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id    = 'whatsnew';
$body_class = '';

require_once $config['file_root'] . '/includes/min/inline.php';
$inline_css_firstrun = min_inline_css('css_firstrun');

$inline_js_utils = min_inline_js('js_utils');

$head_scripts = " ";
$extra_headers = <<<EXTRA_HEADERS
    <meta name="WT.ad" content="Beta;Twitter;Facebook;Participate;Firefox Live;Newsletter" />
    {$inline_css_firstrun}
    {$inline_js_utils}
EXTRA_HEADERS;

$flash1 = 'You should <a href="http://get.adobe.com/flashplayer/">update Adobe Flash Player</a> right now.';
$flash2 = 'Firefox is up to date, but your current version of Flash Player can cause security and stability issues.  Please <a href="http://get.adobe.com/flashplayer/">install the free update</a> as soon as possible.';

if ( $lang != 'en-US' AND ___($flash1) != $flash1 AND ___($flash2) != $flash2 )
{

$str1 = addslashes(___($flash1));
$str2 = addslashes(___($flash2));

$extra_footers = <<<EXTRA_FOOTERS
    <script>
    // <![CDATA[
        FlashAlertTitle = '{$str1}';
        FlashAlertText  = '{$str2}';
    // ]]>
    </script>
EXTRA_FOOTERS;
}

$detect_flash = TRUE;
?>
