<?php

/**
 * Extra HTML head content for the "First Run" page for Firefox 3.5.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id    = 'firstrun';

$page_title    = empty($page_title)    ? 'Mozilla.com' : $page_title;
$textdir       = empty($textdir)       ? 'ltr'         : $textdir;
$extra_headers = empty($extra_headers) ? ''            : $extra_headers;
$extra_feature = empty($extra_feature) ? ''            : $extra_feature;
$extra_css     = empty($extra_css)     ? ''            : $extra_css;
$body_class    = empty($body_class)    ? ''            : $body_class;
$html5         = true;


$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/firstrun-page-3-5.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/video-player.css" media="screen" />
    <script type="text/javascript" src="/includes/yui/2.5.1/utilities/utilities.js"></script>
    <script type="text/javascript" src="/js/mozilla-video-tools.js"></script>
    <script type="text/javascript">
    // <![CDATA[
        Mozilla.VideoPlayer.close_text = '{$l10n->get('Close')}';
        Mozilla.VideoScaler.close_text = '{$l10n->get('Close')}';
    // ]]>
    </script>
EXTRA_HEADERS;


include_once "{$config['file_root']}/includes/headers/3.5/panicmode.inc.php";

?>
