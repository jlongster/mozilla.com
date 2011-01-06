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

$extra_headers = <<<EXTRA_HEADERS
    <style type="text/css">
        /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
        @font-face { font-family: 'MetaWebPro-Book'; src: url('/img/fonts/MetaWebPro-Book.woff') format('woff'); }
        @font-face { font-family: 'MetaWebPro-Bold'; src: url('/img/fonts/MetaWebPro-Bold.woff') format('woff'); }
    </style>
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/firefox/3.6/firstrun-page-3.6.2-3.css" media="screen" />
    <script type="text/javascript" src="{$config['static_prefix']}/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="{$config['static_prefix']}/js/mozilla-expanders.js"></script>
    <script type="text/javascript" src="{$config['static_prefix']}/js/mozilla-input-placeholder.js"></script>
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
    $extra_footers = '<script type="text/javascript" src="'.$config['static_prefix'].'/js/detect-flash.js"></script>';
}

?>
