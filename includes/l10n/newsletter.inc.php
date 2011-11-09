<?php

$body_id = 'newsletter';

$extra_headers = <<<EXTRA_HEADERS
    <style>
    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }
    </style>

    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/newsletter.css" media="screen">
EXTRA_HEADERS;

require_once "{$config['file_root']}/includes/regions.php";
require_once "{$config['file_root']}/includes/email/prefs.php";

$form = new EmailPrefs($_POST);
$form->save_new(array('optin' => FALSE));

require_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";
require_once "{$config['file_root']}/{$lang}/newsletter/content.inc.html";

// form process
if($form->has_success()) {
  echo "<script>
    dcsMultiTrack('WT.si_n', 'Main Newsletter Subscribe', 'WT.si_x', '1', 'WT.si_cs', '1');
  </script>";
}
echo '<script src="'.$config['static_prefix'].'/js/autofocus.js"></script>';

//include footer
require_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";

?>
