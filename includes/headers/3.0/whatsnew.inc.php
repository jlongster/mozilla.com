<?php
/**
 * Extra HTML head content for the "What's new" page for Firefox 3.0.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id    = 'whatsnew';
if(!isset($body_class)) {$body_class = '';}

if(!isset($extra_feature_text)) {$extra_feature_text = '';}

$extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/whatsnew-page.css" media="screen" />
    <script type="text/javascript" src="/js/whats-new-page.js"></script>
EXTRA_HEADERS;

$flash1 = 'You should <a href="http://get.adobe.com/flashplayer/">update Adobe Flash Player</a> right now.';
$flash2 = 'Firefox is up to date, but your current version of Flash Player can cause security and stability issues.  Please <a href="http://get.adobe.com/flashplayer/">install the free update</a> as soon as possible.';

if ( $lang != 'en-US' AND ___($flash1) != $flash1 AND ___($flash2) != $flash2 )
{

$str1 = addslashes(___($flash1));
$str2 = addslashes(___($flash2));

$extra_footers = <<<EXTRA_FOOTERS
    <script type="text/javascript">
    // <![CDATA[
        FlashAlertTitle = '{$str1}';
        FlashAlertText  = '{$str2}';
    // ]]>
    </script>
<script type="text/javascript" src="/js/detect-flash.js"></script>
EXTRA_FOOTERS;
}
elseif ( $lang == 'en-GB' )
{
    $extra_footers = '<script type="text/javascript" src="/js/detect-flash.js"></script>';
}

?>
