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
require_once "{$config['file_root']}/includes/email/forms.php";

// If some localized should be optin, change the last parameter to
// TRUE just for those locales
$form = new LocalizedNewsletterForm('MOZILLA_AND_YOU', $_POST, FALSE);
$status = '';
if ($form->save()) {
    $status = 'success';
} elseif ($form->error) {
    $status = 'error-'. $form->error;
}


require_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";
require_once "{$config['file_root']}/{$lang}/newsletter/content.inc.html";

// form process
if ($status == 'success') {
  echo "<script>
    dcsMultiTrack('WT.si_n', 'Main Newsletter Subscribe', 'WT.si_x', '1', 'WT.si_cs', '1');
  </script>";
}
echo '<script src="'.$config['static_prefix'].'/js/autofocus.js"></script>';

//include footer
require_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";

?>
