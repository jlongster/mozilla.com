<?php
    $body_id = 'phishing-protection';

    $extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/phishing-page.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/mozilla-expanders.css" media="screen" />
    <script type="text/javascript">//<![CDATA[
        function userAgentRedirect(match_string, url) {
            if (navigator.userAgent && navigator.userAgent.indexOf(match_string) != -1)
                window.location = url;
        }
        userAgentRedirect('Firefox/2', '/{$lang}/firefox/phishing-protection/firefox2/');
    //]]></script>
EXTRA_HEADERS;

    $extra_footers = <<<EXTRA_FOOTERS
<script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/js/mozilla-expanders.js"></script>

EXTRA_FOOTERS;

    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
