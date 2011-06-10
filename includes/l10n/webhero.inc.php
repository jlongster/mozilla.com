<?php

    $body_id = 'webhero';

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
    
    body.locale-el #hero .page-title {
        font: 40px/1.4 "League Gothic",Haettenschweiler,"Arial Narrow",sans-serif !important;
    }
    
    body.locale-el #share h3 {
        text-transform: none;
    }
    
    body.locale-ga-IE #hero .page-title,
    body.locale-pl #hero .page-title,
    body.locale-vi #hero .page-title {
        font: 60px/1.4 "League Gothic",Haettenschweiler,"Arial Narrow",sans-serif !important;
    }
    
    body.locale-ar #step2 {
        padding: 50px 350px 10px 230px;
    }
    
    .checklist li {
        min-height: 35px;
    }
    
    #share a:hover,
    #share a:active {
        text-decoration: none;
    }
    
    {$l10n->get('custom-css')}

EXTRA_CSS;

    $extra_footers = <<<EXTRA_FOOTERS
EXTRA_FOOTERS;

    $twitter_message  = rawurlencode($twitter_message);
    $facebook_message = str_replace('%20http://mzl.la/i85nib%20%23fx4', '', $twitter_message);



    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
<!-- Starting a page html here as localizers are not going to touch it -->
<div id="webhero-wrap">
  <section class="step" id="step1">
    <h2><?=___('FIREFOX 4 + YOU = AWESOME!')?></h2>
    <p> <?=___("You already know how awesome Firefox 4 is. You experience it every day. But not everyone is there yet. Some people need a nudge in the right direction. And that's where you come in.")?></p>
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
      <li class="check1"><?=___("Install Firefox 4 on their computer.")?></li>
      <li class="check2"><?=___("Send them a how-to-install video for <a href='/en-US/firefox/video/?video=upgrade-mac' target='_top'>Mac</a> or <a href='/en-US/firefox/video/?video=upgrade-win' target='_top'>PC</a>. Or show them PDF instructions for <a href='/en-US/firefox/webhero/Firefox4_Installation_Guide_MAC.pdf' target='_top' title='Download this PDF (1MB)'>Mac</a> or <a href='/en-US/firefox/webhero/Firefox4_Installation_Guide_PC.pdf' target='_top' title='Download this PDF (1.5MB)'>PC</a>.")?></li>
      <li class="check3"><?=___("Show them the features <a href='/en-US/firefox/central' target='_top'>on your computer</a> or send them a <a href='/en-US/firefox/video/' target=/_top'>video</a>.")?></li>
    </ul>
  </section>

  <section class="step" id="step4">
    <h2><?=___("AWESOME = YOU!")?></h2>
    <p><?=___("Give yourself a pat on the back. You helped someone get the best of the Web and make sure it stays open and awesome. Let's keep building a better Web together.")?></p>

    <div id="share">
      <h3><?=___("I upgraded a friend to Firefox 4!")?></h3>
      <ul>
        <li><a id="share-twitter" title="<?=$twitter_link?>" href="https://twitter.com/?status=<?=$twitter_message;?>"><?=___('Twitter')?></a></li>
        <li><a id="share-facebook" title="<?=$facebook_link?>" href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Fmzl.la%2Fi85nib&amp;t=<?=$facebook_message;?>"><?=___('Facebook')?></a></li>
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
