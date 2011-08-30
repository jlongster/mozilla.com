<?php

// commodity variable to bypass the controller
if(isset($retour) && $retour == true) {
    $retour = false;
    return;
}

define('UI_LANG', $lang);

// commodity functions for localized pages
include_once $config['file_root'].'/includes/l10n/toolbox.inc.php';


// make sure we have a few variables defined to avoid php warnings if they don't exist
$head_add         = (isset($head_add))          ? $head_add         : '';
$body_id          = (isset($body_id))           ? $body_id          : '';
$pageid           = (isset($pageid))            ? $pageid           : '';
$body_class       = (isset($body_class))        ? $body_class       : '';
$meta_description = (isset($meta_description))  ? $meta_description : '';
$extra_headers    = (isset($extra_headers))     ? $extra_headers    : '';
$extra_footers    = (isset($extra_footers))     ? $extra_footers    : '';
$page_title       = empty($page_title)          ? 'Mozilla.com'     : $page_title;
$extra_feature    = empty($extra_feature)       ? ''                : $extra_feature;
$extra_css        = empty($extra_css)           ? ''                : $extra_css;
$body_class       = empty($body_class)          ? ''                : $body_class;
$textdir          = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';
$footerfile       = $config['file_root'].'/includes/l10n/footer-pages.inc.php';
$headerfile       = $config['file_root'].'/includes/l10n/header-pages.inc.php';

// we never want the domain to be locale.www.mozilla.com,
// old legacy bug (398938) causing bugs with links when switching locale
// safety mesure for cases when we forget to use $config['server_name'] in a script

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

// Create a variable to know if we are on production or not
$publicsites = array('www.mozilla.org', 'mozilla.org', 'www.mozilla.com', 'mozilla.com');
$stage = (!in_array($config['server_name'], $publicsites)) ? true: false;
unset($publicsites);

// pt-BR is an experiment of having the whole site localized so we don't want to include all our l10n site
// but mix it with en-US header page.

if ($lang == 'pt-BR' && $pageid == '') return;


// Bug 672498: send en-GB users to fresher en-US content for existing pages
// en-ZA is just a remap of en-US in inludes/langconfig.inc.php so no action needed for this locale
if ($lang == 'en-GB') {
    goToEnglishPage();
}


// here we define our per-page includes
$sitepages = array(
    'landing'           => 'landing-page.inc.php',
    'oldversion'        => 'oldversion.inc.php',
    'about'             => 'about.inc.php',
    'central'           => 'central.inc.php',
    'mobile-home'       => 'mobile-home.inc.php',
    'mobile-customize'  => 'mobile-customize.inc.php',
    'mobile-developers' => 'mobile-developers.inc.php',
    'mobile-platforms'  => 'mobile-platforms.inc.php',
    'mobile-sync'       => 'mobile-sync.inc.php',
    'mobile-features'   => 'mobile-features.inc.php',
    'mobile-download'   => 'mobile-download.inc.php',
    'community'         => 'community.inc.php',
    'security'          => 'security.inc.php',
    'm-support'         => 'm-support.inc.php',
    'm-beta'            => 'mobile-m-beta.inc.php',
    'm-landing'         => 'm-landing.inc.php',
    'm-channel'         => 'm-channel.inc.php',
    'unsupported'       => 'unsupported-version.inc.php',
    'firstrun-36'       => '3.6/firstrun.inc.php',
    'whatsnew-36'       => '3.6/whatsnew-v2.inc.php',
    'antiphishing'      => 'antiphishing.inc.php',
    'firstrun-4'        => '4/firstrun.inc.php',
    'whatsnew-4'        => '4/whatsnew.inc.php',
    'firefox4-rc'       => '4/download-rc.inc.php',
    'MU-fx4'            => '4/majorupdate-v1.inc.php',
    'MU-fx4beta'        => '4/majorupdate-v2.inc.php',
    'firefox-features'  => 'desktop-features.inc.php',
    'firefox-channels'  => 'channels.inc.php',
    'newsletter'        => 'newsletter.inc.php',
    'webhero'           => 'webhero.inc.php',
    'plugincheck'       => 'plugincheck.inc.php',
    'dl-transition'     => 'download-transition-pages.inc.php',
    'latest'            => 'latest.inc.php',
    'latest-from-3.6'   => 'latest-from-3.6.inc.php',
);

// pages deactivated on production
$deactivated = array(
    '',
);

// add the include if it exists only
if ($pageid != '' && in_array($pageid, $deactivated) && $config['server_name'] == 'www.mozilla.com') {
    goToEnglishPage();
    exit;
}


// add the include if it exists only
if (array_key_exists($pageid, $sitepages) && $sitepages[$pageid] != '') {
    include $config['file_root'].'/includes/l10n/'.$sitepages[$pageid];
} else {
    include $config['file_root'].'/includes/l10n/header-pages.inc.php';
}
