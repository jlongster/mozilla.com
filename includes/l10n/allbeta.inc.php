<?php

/* redirect to home, no beta now */
// commodity functions for localized pages
include_once $config['file_root'].'/includes/l10n/toolbox.inc.php';

$a = explode('.', $_SERVER['SERVER_NAME']);

if (in_array($a[0], $full_languages) || in_array(strtolower($a[0]), $full_languages)) {
    array_shift($a);
    $_SERVER['SERVER_NAME'] = implode($a);
}

unset($a);

// a few commodity variables that are much easier to use in the template than appending config vars
$host_root = $config['url_scheme'].'://'.$config['server_name'].'/';
$host_l10n = $host_root.$lang;
$host_enUS = $host_root.'en-US';

noCachingRedirect($host_l10n);
exit;


    include_once "{$config['file_root']}/includes/l10n/locale-transition-status.inc.php";

    $body_id = 'firefox-all';

    if(!isset($meta_description)) {$meta_description = '';}
    if(!isset($extra_headers)) {$extra_headers = '';}


    $extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/firefox.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/all.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/all-beta.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/style/firefox/beta/4/main.css"  />
EXTRA_HEADERS;

    $firefoxDetails -> download_base_url_transition = "/$lang/download/";
    $firefoxDetails -> has_transition_download_page = $betaTransitionPage;

    // if we don't have builds for a locale yet, let's display an en-US build to avoid php warnings
    if(!isset($firefoxDetails->primary_builds[$lang][LATEST_FIREFOX_DEVEL_VERSION])) {
        $box = $firefoxDetails->getDownloadBlockForLocale('en-US', array('ancillary_links' => false, 'download_product' => 'Free Download', 'devel_version' => true) );
    } else {
        $box = $firefoxDetails->getDownloadBlockForLocale($lang, array('ancillary_links' => false, 'download_product' => 'Free Download', 'devel_version' => true) );
    }

    $versionnumber = LATEST_FIREFOX_DEVEL_VERSION;
    $downloadbox = <<<BOX
    <script type="text/javascript" src="{$config['static_prefix']}/js/download.js"></script>
    <script type="text/javascript">
    // <![CDATA[
        var download_parent_override = 'download-button';
    // ]]>
    </script>
    <div id="download-button">

    {$box}
    <p class="download-other">
        <a class="ancillaryLink" href="{$versionnumber}/releasenotes/">{$l10n->get('Release Notes')} {$l10n->get('(in English)')}</a> -
        <a class="ancillaryLink" href="http://www.mozilla.com/en-US/firefox/all-beta.html#languages">{$l10n->get('Other Systems and Languages')}</a>
    </p>

    </div>
    <!-- end #download-button div -->
BOX;



    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
