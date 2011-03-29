<?php

// we redirect this page direcly to the download page
noCachingRedirect($host_l10n.'/mobile/download/');
exit;


$body_id    = 'mobile-home';

if(!isset($meta_description)) {$meta_description = '';}
if(!isset($extra_headers)) {$extra_headers = '';}


if(!isset($extra_headers)) { $extra_headers=''; }

$extra_headers .= <<<EXTRA_HEADERS

      <link rel="stylesheet" type="text/css" href="/style/tignish/mobile-later.css" media="screen" />
      <script type="text/javascript" src="/js/mobile-desktop.js"></script>
      <style type="text/css">
        #mobile-faq #q26, #mobile-faq #q26 + dd
        {
            display:none;
        }

        #mobile-faq.locale-en-GB #q26, #mobile-faq.locale-en-GB #q26 + dd
        {
            display:auto;
        }

        #mobile-developers #main-feature h2
        {
            font-size:300% !important;
            margin:0 380px 0 35px !important;
        }

        #mobile-developers #main-feature p
        {
            font-size:160% !important;
        }

      </style>

EXTRA_HEADERS;

include_once "{$config['file_root']}/includes/headers/mobile/home.php";
$mobilesubmenu = '<div>'.buildMobileSubPageMenu($lang, 'mobile').'</div>';
$smsform       = sms::form();
$smsformblock  = <<<SMS

<div id="main-content">
    <div id="mobile-feature">
     <div id="download-options">
       <div id="download-primary">
         <h4>{$l10n->get('Download Firefox directly from your phone')}</h4>
         <p id="download-instructions"><a href="/{$lang}/m/">{$l10n->get('Get it now on the Nokia N900')}</a></p>
       </div>
       <div id="download-other">
         {$smsform}
       </div>
     </div>
    <div id="mobile-feature-footer"></div>
    </div>
</div>

SMS;




include_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
