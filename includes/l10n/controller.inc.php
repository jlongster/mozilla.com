<?php

// make sure we have a few variables defined to avoid php warnings if they don't exist
$head_add         = (isset($head_add)) ? $head_add                 : $head_add = '';
$body_class       = (isset($body_class)) ? $body_class             : $body_class = '';
$meta_description = (isset($meta_description)) ? $meta_description : $meta_description = '';
$extra_headers    = (isset($extra_headers)) ? $extra_headers       : $extra_headers = '';
$page_title       = empty($page_title)    ? 'Mozilla.com'          : $page_title;
$extra_feature    = empty($extra_feature) ? ''                     : $extra_feature;
$extra_css        = empty($extra_css)     ? ''                     : $extra_css;
$body_class       = empty($body_class)    ? ''                     : $body_class;
$textdir          = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';



// dummy function to avoid error in code borrowed from mozilla-europe
function localeConvert($lang) {
    return $lang;
}

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
);

// add the include if it exists only
if (array_key_exists($pageid, $sitepages) && $sitepages[$pageid] != '') {
    include $_SERVER['DOCUMENT_ROOT'].'/includes/l10n/'.$sitepages[$pageid];
} else {
    include $_SERVER['DOCUMENT_ROOT'].'/includes/l10n/header-pages.inc.php';
}

?>
