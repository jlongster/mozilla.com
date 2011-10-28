<?php

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';

// temporary include to parallelize webdev and l10n- webdev work on the project
require_once $config['file_root'].'/includes/l10n/firefoxlive-helper.inc.php';

$extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/firefoxlive.css" media="screen" />
EXTRA_HEADERS;


// RTL support for Mozilla.com
if ($textdir == 'rtl') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/covehead/rtl.css" media="screen" />
EXTRA_HEADERS;
}

// no italic for Chineses
if ($lang == 'zh-CN' || $lang == 'zh-TW') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/l10n/covehead/chinese-mod.css" media="screen" />
EXTRA_HEADERS;
}

// no uppercasing for Greek
if ($lang == 'el') {
    $extra_headers  = <<<EXTRA_HEADERS
    {$extra_headers}
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/l10n/covehead/greek-mod.css" media="screen" />
EXTRA_HEADERS;
}


$body_id    = '';
$page_title = 'Firefox Live';

$share_facebook = '<div class="fb-like" data-send="true" data-layout="button_count" data-width="200" data-show-faces="true"></div>';
$share_twitter  = '<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="cubcaretaker">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';

$overlay_twitter = '<div id="overlay-twitter"><a href="https://twitter.com/cubcaretaker" class="twitter-follow-button" data-show-count="false">Follow @cubcaretaker</a><script src="//platform.twitter.com/widgets.js" type="text/javascript"></script></div>';
$overlay_facebook = '<div id="overlay-facebook"><div class="fb-like" data-send="false" data-width="200" data-show-faces="false" data-font="arial"></div></div>';

$overlay_image = '<img src="'.$config['static_prefix'].'/img/covehead/firefoxlive/overlay-facebook.png" alt="" />';

$button_firefox = '<img src="'.$config['static_prefix'].'/img/covehead/firefoxlive/logo-firefox.png" alt="" />';
$button_zoo     = '<img src="'.$config['static_prefix'].'/img/covehead/firefoxlive/logo-zoo.png" alt="" />';

$video_code =  <<<VIDEO_CODE
<div id="video">
<script src="http://player.ooyala.com/player.js?width=444&height=334&embedCode=s0MmVvMTrSlB1ZLzaWXnKZaa42Ib5rJV"></script>
</div>
VIDEO_CODE;

// Header

?>
<!DOCTYPE HTML>
<html lang="<?=$lang?>" dir="<?=$textdir?>">
<head>
    <meta charset="utf-8">
    <title><?=$page_title?></title>

    <style>
    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('<?=$config['static_prefix']?>/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('<?=$config['static_prefix']?>/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }
    </style>

    <link href="<?=$config['static_prefix']?>/includes/min/min.css?g=css" rel="stylesheet">
    <script src="<?=$config['static_prefix']?>/includes/min/min.js?g=js"></script>
<!--[if lte IE 9]>
<script src="<?=$config['static_prefix']?>/js/html5.js"></script>
<![endif]-->
    <? if ($lang == 'en-US') { ?>
    <script src="<?=$config['static_prefix']?>/js/jquery/jquery.tweet.js"></script>
    <script type='text/javascript'>
        jQuery(function($){
            $("#tweet").tweet({
                count: 2,
                username: 'cubcaretaker',
                template: "{text} {time}"
            });
        });
    </script>
    <? } ?>
    <?=$extra_headers?>

</head>

<body id="<?=$body_id?>" class="<?=$body_class?> locale-<?=$lang?>  <?=$textdir?>">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?=$fb_locale?>/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="wrapper">
<div id="doc">

    <header id="branding">
        <div id="nav-mozilla">
            <a href="http://www.mozilla.org/" class="mozilla" title="<?=str_replace('.com', '.org', $l10n->get('Visit Mozilla.com'));?>">Mozilla</a>
        </div>

        <h1 id="site-title"><img src="<?=$config['static_prefix']?>/img/covehead/firefoxlive/title.png" height="94" alt="<?=$l10n->get('Firefox Live')?>" /></h1>

    </header>

    <section id="content-main">
    <? require_once $config['file_root'].'/'.$lang.'/firefoxlive/content.inc.html'; ?>
    <? if ($lang == 'en-US') { ?>
    <section id="tweet-container">
        <h4>Follow us <a href="http://www.twitter.com/cubcaretaker/">@cubcaretaker</a></h4>
        <div id="tweet"></div>
        <a class="tweet-more" href="http://www.twitter.com/cubcaretaker/"><?=$l10n->get('View more tweets')?>
        <a class="tweet-follow" href="https://twitter.com/intent/user?screen_name=cubcaretaker">Follow @cubcaretaker</a>
    </section>
    <? } ?>
    </section><!-- end #content-main -->


    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

<?
$lang_list          = getLangLinksSelect(array( 'en-US', 'fr' ));
$lang_list          = str_replace(' (España)', '', $lang_list);
$lang_list          = str_replace(' (US)', '', $lang_list);
$current_year       = date('Y');
$extra_footers      = empty($extra_footers) ? '' : $extra_footers;
$extra_footer_links = empty($extra_footer_links) ? '' : $extra_footer_links;
$creative_commons   = sprintf(___('Except where otherwise <a href="%s">noted</a>, content on this site is licensed under the <br /><a href="%s">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.'),"/$lang/about/legal.html#site", 'http://creativecommons.org/licenses/by-sa/3.0/');
$creative_commons   = str_replace('<br />', '', $creative_commons);

// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

?>

    <footer id="footer">
    <div class="section">

        <div id="copyright">
            <p id="footer-links"><a href="/<?=$lang?>/privacy-policy.html"><?=$l10n->get('Privacy Policy')?></a> &nbsp;|&nbsp;
            <a href="/<?=$lang?>/about/legal.html"><?=$l10n->get('Legal Notices')?></a> &nbsp;|&nbsp;
                        <a href="/<?=$lang?>/legal/fraud-report/index.html"><?=$l10n->get('Report Trademark Abuse')?></a></p>
            <p><?=$creative_commons?></p>
        </div>

        <form id="lang_form" class="languages"  dir="<?=$textdir?>" method="get" action="<?=$host_root?>includes/l10n/langswitcher.inc.php"><div>
            <label for="flang"><?=$l10n->get('Other languages:')?></label>
            <?=$lang_list?>
            <noscript>
                <div><input type="submit" id="lang_submit" value="<?=$l10n->get('Go')?>" /></div>
            </noscript>
        </div></form>

    </div>
    </footer>
    <!-- end #footer -->
    <?=$stats_js?>
    <?=$extra_footers?>

</body>
</html>
