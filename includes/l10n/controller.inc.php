<?php

// make sure we have a few variables defined to avoid php warnings if they don't exist
$head_add         = (isset($head_add)) ? $head_add                 : '';
$body_id          = (isset($body_id)) ? $body_id                   : '';
$body_class       = (isset($body_class)) ? $body_class             : '';
$meta_description = (isset($meta_description)) ? $meta_description : '';
$extra_headers    = (isset($extra_headers)) ? $extra_headers       : '';
$page_title       = empty($page_title)    ? 'Mozilla.com'          : $page_title;
$extra_feature    = empty($extra_feature) ? ''                     : $extra_feature;
$extra_css        = empty($extra_css)     ? ''                     : $extra_css;
$body_class       = empty($body_class)    ? ''                     : $body_class;
$textdir          = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';
$footerfile       = $config['file_root'].'/includes/l10n/footer-pages.inc.php';


// dummy function to avoid error in code borrowed from mozilla-europe
function localeConvert($lang) {
    return $lang;
}


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
$host_l10n = $config['url_scheme'].'://'.$config['server_name'].'/'.$lang;
$host_enUS = $config['url_scheme'].'://'.$config['server_name'].'/en-US';


// here we define our per-page includes
$sitepages = array(
    'oldversion'         => 'oldversion.inc.php',
    'about'              => 'about.inc.php',
    'central'            => 'central.inc.php',
    'mobile-home'        => 'mobile-home.inc.php',
    'mobile-customize'   => 'mobile-customize.inc.php',
    'mobile-developers'  => 'mobile-developers.inc.php',
    'mobile-platforms'   => 'mobile-platforms.inc.php',
    'mobile-sync'        => 'mobile-sync.inc.php',
    'mobile-features'    => 'mobile-features.inc.php',
    'community'          => 'community.inc.php',
    'security'           => 'security.inc.php',
    'm-support'          => 'm-support.inc.php',
    'unsupported'        => 'unsupported-version.inc.php',
    'firstrun-36'        => '3.6/firstrun.inc.php',
    'whatsnew-36'        => '3.6/whatsnew.inc.php',
    'antiphishing'       => 'antiphishing.inc.php',
);

// add the include if it exists only
if (array_key_exists($pageid, $sitepages) && $sitepages[$pageid] != '') {
    include $_SERVER['DOCUMENT_ROOT'].'/includes/l10n/'.$sitepages[$pageid];
} else {
    include $_SERVER['DOCUMENT_ROOT'].'/includes/l10n/header-pages.inc.php';
}

?>
