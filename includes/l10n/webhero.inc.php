<?php

    $body_id = 'webhero';


    $productionQuality = array('de', 'el', 'es-ES', 'fr', 'fy-NL', 'gl', 'lt', 'nl', 'pt-BR' );

    checkProductionQuality($lang, $productionQuality);

    require_once "{$config['file_root']}/includes/l10n/remaps.inc.php";
    require_once "{$config['file_root']}/includes/js_stats.inc.php";

    if(isset($mapped_lang)) {
        l10n_moz::load($config['file_root'] . '/en-US/firefox/webhero/fb/locale/' . $mapped_lang . '/LC_MESSAGES/messages.po', 'po');
    } else {
        l10n_moz::load($config['file_root'] . '/en-US/firefox/webhero/fb/locale/' . $lang . '/LC_MESSAGES/messages.po', 'po');
    }

    $extra_headers .= <<<EXTRA_HEADERS
        <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/webhero.css" media="screen">
        <script src="{$config['static_prefix']}/includes/min/min.js?g=js&amp;2011-05-20"></script>
        <script type="text/javascript" src="{$config['static_prefix']}/js/jquery/jquery.nyroModal.pack.js"></script>
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <script src="{$config['static_prefix']}/js/html5.js"></script>
        <![endif]-->

EXTRA_HEADERS;


    $extra_css .= <<<EXTRA_CSS

    #hero .page-title {
        font: 70px/1.4 "League Gothic",Haettenschweiler,"Arial Narrow",sans-serif !important;
    }

    #webhero #copyright {
        font-size: 13px !important;
        margin: inherit !important;
        opacity: inherit !important;
        text-align: inherit !important;
    }

    .checklist li {
        min-height: 35px;
    }

    #share a:hover,
    #share a:active {
        text-decoration: none;
    }

    body.locale-el #webhero-wrap h2,
    body.locale-lt #webhero-wrap h2,
    body.locale-pl #webhero-wrap h2,
    body.locale-el #webhero-wrap h1.page-title,
    body.locale-lt #webhero-wrap h1.page-title,
    body.locale-pl #webhero-wrap h1.page-title,
    body.locale-el #share h3,
    body.locale-lt #share h3,
    body.locale-pl #share h3
    {
        font-family: "Arial Narrow", sans-serif !important;
        font-weight: bold !important;
    }

    body.locale-el #webhero-wrap h2,
    body.locale-lt #webhero-wrap h2,
    body.locale-pl #webhero-wrap h2
    {
        font-size:   35px !important;
        line-height: 35px !important;
    }

    body.locale-el #webhero-wrap h1.page-title,
    body.locale-pl #webhero-wrap h1.page-title
    {
        font-size:   36px !important;
        line-height: 50px !important;
    }

    body.locale-lt #webhero-wrap h1.page-title
    {
        font-size:   40px !important;
        line-height: 100px !important;
    }


    body.locale-el #share h3,
    body.locale-lt #share h3,
    body.locale-pl #share h3
    {
        text-transform: none;
        font-size:0.9em;
    }

    body.locale-ga-IE #hero .page-title,
    body.locale-vi #hero .page-title
    {
        font: 60px/100px "League Gothic",Haettenschweiler,"Arial Narrow",sans-serif !important;
    }

    body.locale-ar #step2 {
        padding: 50px 350px 10px 230px;
    }

    {$l10n->get('custom-css')}

EXTRA_CSS;

    $extra_footers = <<<EXTRA_FOOTERS
EXTRA_FOOTERS;

    $twitter_message  = str_replace('http://mzl.la/i85nib', 'http://firefox.com', $twitter_message);
    $twitter_message  = rawurlencode($twitter_message);
    $facebook_message = $twitter_message;



    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
<!-- Starting a page html here as localizers are not going to touch it -->
<div id="webhero-wrap">
  <section class="step" id="step1">
    <h2><?=___('FIREFOX + YOU = AWESOME!')?></h2>
    <p> <?=___("You already know how awesome Firefox is. You experience it every day. But not everyone is there yet. Some people need a nudge in the right direction. And that's where you come in.")?></p>
  </section>

  <div id="hero">
    <h1 class="page-title"><?=___("BE A WEB HERO")?></h1>
  </div>

  <section class="step" id="step2">
    <h2><?=___("KNOW SOMEONE BROWSING IN THE PAST?")?></h2>
    <p><?=___("Chances are you know someone who isn't on Team Firefox yet. They're missing out on the awesome. And it wouldn't be fair to keep it all for yourself.")?></p>
  </section>

  <section class="step" id="step3">
    <h2><?=___("HELPING IS EASY!<br />AND IT FEELS GREAT!")?></h2>
    <p><?=___("Help Team Firefox grow. Here's how:")?></p>
    <ul class="checklist">
      <li class="check1"><?=___("Install Firefox on their computer.")?></li>
      <li class="check2"><?php printf(___("Send them a how-to-install video for <a href='%s' target='_top'>Mac</a> or <a href='%s' target='_top'>PC</a>. Or show them PDF instructions for <a href='%s' target='_top' title='Download this PDF (1MB)'>Mac</a> or <a href='%s' target='_top' title='Download this PDF (1.5MB)'>PC</a>."),
                                    /* L10n: URL of the how-to-install video for Mac */
                                    ___("/en-US/firefox/video/?video=upgrade-mac"),
                                    /* L10n: URL of the how-to-install video for PC */
                                    ___("/en-US/firefox/video/?video=upgrade-win"),
                                    /* L10n: URL of the how-to-install PDF for Mac */
                                    ___("/en-US/firefox/webhero/Firefox_Installation_Guide_MAC.pdf"),
                                    /* L10n: URL of the how-to-install PDF for PC */
                                    ___("/en-US/firefox/webhero/Firefox_Installation_Guide_PC.pdf")); ?></li>
      <li class="check3"><?php printf(___("Show them the features <a href='%s' target='_top'>on your computer</a> or send them a <a href='%s' target=/_top'>video</a>."),
                                        /* L10n: URL for "show them the features on your computer" */
                                        "/$lang/firefox/features/",
                                        /* L10n: URL for "send them a video" */
                                        ___("/en-US/firefox/video/")); ?>
      </li>
    </ul>
  </section>

  <section class="step" id="step4">
    <h2><?=___("AWESOME = YOU!")?></h2>
    <p><?=___("Give yourself a pat on the back. You helped someone get the best of the Web and make sure it stays open and awesome. Let's keep building a better Web together.")?></p>

    <div id="share">
      <h3><?=___("I upgraded a friend to the new Firefox!")?></h3>
      <ul>
        <li><a id="share-twitter" title="<?=$twitter_link?>" href="https://twitter.com/?status=<?=$twitter_message;?>"><?=___('Twitter')?></a></li>
        <li><a id="share-facebook" title="<?=$facebook_link?>" href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.mozilla.com%2F<?=$lang?>%2Ffirefox%2F&amp;t=<?=$facebook_message;?>"><?=___('Facebook')?></a></li>
        <li><a id="share-email" title="<?=$email_link?>" href="#email-box"><?=___('Email')?></a></li>
      </ul>
    </div>

    <script type="text/javascript">
    // <![CDATA[
        $(document).ready(function(){
            $("#share-email").nyroModal();
        });
    // ]]>
    </script>

  </section>
</div>



<?php
    require_once "{$config['file_root']}/{$lang}/firefox/webhero/emailbox.inc.html";
    echo $stats_js;
    require_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
