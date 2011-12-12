<?php

/**
 * Processing of the Download transition page for locales
 */

// get commodity functions for localized pages
require_once $config['file_root'] . '/includes/l10n/toolbox.inc.php';
require_once $config['file_root'] . '/includes/l10n/locale-transition-status.inc.php';


// inlining functions
require_once $config['file_root'] . '/includes/min/inline.php';

// redirect if malformed url to firefox download page
if (!isset($_GET['product']) || !isset($_GET['lang']) || !isset($_GET['os'])) {
    noCachingRedirect('http://www.mozilla.com/firefox/');
}

// get key strings
l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/download.lang');

$page_title    = 'Mozilla - '.___('Download');
$body_id       = 'download';
$dl_product    = htmlspecialchars(strip_tags($_GET['product']), ENT_QUOTES);
$dl_lang       = htmlspecialchars(strip_tags($_GET['lang']), ENT_QUOTES);
$dl_os         = htmlspecialchars(strip_tags($_GET['os']), ENT_QUOTES);
$extra         = (isset($_GET['extra'])) ? secureText($_GET['extra']) : '';
$nodownload    = (isset($_GET['nodownload'])) ? true: false;
$dl_link       = "http://download.mozilla.org/?product={$dl_product}&os={$dl_os}&lang={$dl_lang}";

if (!$nodownload) {
    $extra_footers .= get_include_contents($config['file_root'] . '/js/download-transition-l10n.js');
}



?>
<!DOCTYPE HTML>
<html lang="<?=$lang?>" dir="<?=$textdir?>">
<head>
    <meta charset="utf-8">
    <link href="/includes/min/min.css?g=css" rel="stylesheet">
    <meta name="viewport" content="width=1024">
    <link rel="stylesheet" href="/style/kampyle/k_button.css" media="screen" />
    <link rel="stylesheet" href="/style/covehead/download-page.css" media="screen" />

    <title><?=$page_title?></title>

<?php
    //~ echo min_inline_css('css');
    //~ echo min_inline_css('css_home');
?>
    <style>
    </style>
</head>

<body id="<?=$body_id?>" class="darkbg locale-<?=$lang?> <?=$textdir?>">

    <div id="wrapper">

        <div id="doc">

            <!-- start #header -->
            <div id="header">

                <div>
                    <h1><a title="Back to home page" href="<?=$host_l10n?>/firefox/">Mozilla Firefox</a></h1>
                    <a class="mozilla" href="<?=$host_enUS?>/">mozilla</a>
                </div>
                <hr class="hide" />
            </div>
            <!-- end #header -->

            <div id="download-message">
                <div class="main-feature" id="main-feature">
                    <h2><?e__('Welcome to the only browser <em>that puts you first.</em>');?></h2>
                </div>

                <div id="content">
                    <div id="content-msg">
                            <p id="download-thanks"><?e__('Thanks for choosing Firefox!');?> <?e__('As a non-profit, we’re free to innovate on your behalf without any pressure to compromise. You’re going to love the difference.');?> </p>
                            <p class="manual-download"><?php echo sprintf(___('Your download should automatically begin in a few seconds, but if not, <a href="%s">click here</a>.'), $dl_link); ?></p>
                    </div><!-- end #content-msg -->
                </div><!-- end #content -->
            </div><!-- end #download-message -->

            <div class="footer-links">
                <a href="/firefox/features/"><?e__('Desktop');?></a> &nbsp;|&nbsp;
                <a href="/<?=$lang?>/mobile/"><?e__('Mobile');?></a> &nbsp;|&nbsp;
                <a href="https://addons.mozilla.org/"><?e__('Add-ons');?></a> &nbsp;|&nbsp;
                <a href="http://support.mozilla.com/"><?e__('Support');?></a> &nbsp;|&nbsp;
                <a href="/<?=$lang?>/firefox/about/"><?e__('About');?></a>

                <div class="footer-privacy">
                  <a href="/privacy-policy.html"><?e__('Privacy Policy');?></a> &nbsp;|&nbsp;
                  <a href="/en-US/about/legal.html"><?e__('Legal Notices');?></a>
                </div>
            </div><!-- end #footer-links -->

        </div><!-- end #doc -->
    </div><!-- end #wrapper -->



</body>
</html>



