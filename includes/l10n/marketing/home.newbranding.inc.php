<?php

$body_id = 'home';

// Webtrends stats, see bug 556384
require_once $config['file_root'] . '/includes/js_stats.inc.php';

// Persistent Upgrade messaging, only display if it is translated
require_once $config['file_root'] . '/includes/l10n/upgrade-messaging.inc.php';

// inlining functions
require_once $config['file_root'] . '/includes/min/inline.php';

// download page specific strings
$l10n->load($config['file_root'].'/'.$lang.'/includes/l10n/download.lang');
?>

<!DOCTYPE HTML>
<html lang="<?=$lang?>" dir="<?=$textdir?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1024">
    <meta name="og:image" content="/img/firefox-100.jpg">
    <meta name="description" content="<?e__('Mozilla Firefox, free web browser, is created by a global non-profit dedicated to putting individuals in control & shaping the future of the web for the public good.');?>" />
    <link rel="canonical" href="<?=$config['url_scheme'] .'://' . $config['server_name'] ."/$lang/firefox/"?>">

<?php if ($lang == 'zh-CN' || $lang == 'zh-TW') : ?>
    <link rel="stylesheet" type="text/css" href="<?=$config['static_prefix'];?>/style/l10n/covehead/chinese-mod.css" media="screen" />
<?php endif; ?>

<?php if ($lang == 'el') : ?>
    <link rel="stylesheet" type="text/css" href="<?=$config['static_prefix'];?>/style/l10n/covehead/greek-mod.css" media="screen" />
<?php endif; ?>

    <title><?=$page_title?></title>

<?php
    echo min_inline_css('css');
    echo min_inline_css('css_home');
?>
    <style>
    #wrapper {
        background: #e04113 url({$config['static_prefix']}/img/covehead/firefox/ab/dbd-feature-bg.jpg) 50% 0 no-repeat;
    }
    #home #main-feature {
        padding-bottom: 30px;
    }
    #home #main-feature h2 {
        padding-top: 135px;
        font-size: 58px;
        width: 550px;
        color: #fff;
    }
    #home ul#benefits li {
        color: #fff;
        background: none;
        border-left: 2px dotted #ffa800;
        padding-top: 6px;
        margin-top: 4px;
        font-size: 20px;
        line-height:21px;
    }
    #home ul#benefits li.first {
        border-left: 0;
    }
    #download .download-noscript h3 span a,
    #download .download-noscript h3 span a:link,
    #download .download-noscript h3 span a:visited,
    .download-other a,
    .download-other a:link,
    .download-other a:visited {
        color: #ffcf72;
    }
    #home #mobile-promo a {
        color: #fff;
        background: rgb(240,78,40);
        background: rgba(255,255,255,0.05);
        border: 1px solid #dd3611;
        -webkit-box-shadow: 0 0 0 1px rgba(255,255,255,0.1) inset;
        -moz-box-shadow: 0 0 0 1px rgba(255,255,255,0.1) inset;
        box-shadow: 0 0 0 1px rgba(255,255,255,0.1) inset;
        display: inline-block;
        padding: 7px 40px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }
    #home #mobile-promo a:hover,
    #home #mobile-promo a:active {
        background: rgb(224,67,31);
        background: rgba(255,255,255,0.1);
    }
    .footer-links {
        color: #ccc;
        font-size: 16px;
    }
    .footer-links .footer-privacy {
        font-size: 11px;
        margin-top: 15px;
        padding-bottom: 20px;
    }
    .footer-links a,
    .footer-links a:link,
    .footer-links a:visited {
        color: #555;
    }
    .footer-links .footer-privacy a,
    .footer-links .footer-privacy a:link,
    .footer-links .footer-privacy a:visited {
        color: #999;
    }

    * html a.download-link span.download-content{
        background:url({$config['static_prefix']}/img/covehead/firefox/ab/download-ie6-dbd.jpg) 0 0 no-repeat
    }


    body.locale-fr a.download-link span.download-content {
        font-size: 16px;
        line-height: 25px;
    }

    body.locale-el#home  #main-feature h2 {
        line-height: 56px;
        padding-top: 80px;
    }

    body.locale-el#home ul#benefits li {
        font-size:18px;
        padding: 5px 8px;
    }

    body.locale-hu#home #main-feature h2 {
        color: #FFFFFF;
        font-size: 54px;
        padding-top: 155px;
    }

    body.locale-lv#home #main-feature h2 {
        font-size: 52px;
    }

    </style>

<?php if($textdir == "rtl"): ?>
<style>

    #home #wrapper {
        background: #e04113 url(<?=$config['static_prefix']?>/img/covehead/firefox/ab/dbd-feature-bg.jpg) 250% 0 no-repeat;
    }


    #home ul#benefits li {
        float: right;
        border-right: 2px dotted #FFA800;
        border-left: none;
    }

    #home ul#benefits li.first {
        border-right:none;
    }

    #home #home-download {
        clear: right;
    }

    a.download-link span.download-content {
        padding-right: 50px;
    }

</style>
<?php endif; ?>


</head>

<body id="<?=$body_id?>" class="locale-<?=$lang?> <?=$textdir?>">

<div id="wrapper">

    <div id="doc">

        <!-- start #header -->
        <div id="header">
            <div>
                <a class="mozilla" href="<?=$host_enUS?>/">mozilla</a>
            </div>
            <hr class="hide" />
        </div>
        <!-- end #header -->

        <span id="feature-extra"></span>

        <div id="main-feature">
            <h2><?e__('Different by Design');?></h2>
            <ul id="benefits">
                <li class="first"><?e__('Proudly <span>non-profit</span>');?></li>
                <li><?e__('Innovating <span>for you</span>');?></li>
                <li><?e__('Fast, flexible, <span>secure</span>');?></li>
            </ul>

            <div id="home-download">
                <?=$downloadbox?>
            </div>
            <hr class="hide" />
        </div>

<?php
// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";
require "{$config['file_root']}/includes/l10n/upgrade-messaging.inc.php";
?>

    </div><!-- end #doc -->
</div><!-- end #wrapper -->

    <!-- end #footer -->
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

  </div>

    <?=$stats_js?>
    <?=$upgrade_warning?>

</body>
</html>





