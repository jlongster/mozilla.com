<?php
    $body_id    = 'webhero';
        
    if(!isset($extra_headers)) {$extra_headers = '';}
    if(!isset($extra_css))     {$extra_css     = '';}
    
    include_once "{$config['file_root']}/includes/js_stats.inc.php";
    l10n_moz::load($config['file_root'].'/includes/l10n/gettext_externals/webhero/'.$lang.'/LC_MESSAGES/messages.po', 'po');    
    
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
        #webhero #copyright {
            font-size: 100% !important;
            margin: 0 !important;    
        }
EXTRA_CSS;

    $extra_footers = <<<EXTRA_FOOTERS
EXTRA_FOOTERS;

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
      <li class="check1"><?=___("Install Firefox 4 on their computer.")?> Get up close and personal and show them the awesome first hand.</li>
      <li class="check2"><?=___("Send them a how-to-install video for <a href='/en-US/firefox/video/?video=upgrade-mac' target='_top'>Mac</a> or <a href='/en-US/firefox/video/?video=upgrade-win' target='_top'>PC</a>. Or show them PDF instructions for <a href='/en-US/firefox/webhero/Firefox4_Installation_Guide_MAC.pdf' target='_top' title='Download this PDF (1MB)'>Mac</a> or <a href='/en-US/firefox/webhero/Firefox4_Installation_Guide_PC.pdf' target='_top' title='Download this PDF (1.5MB)'>PC</a>.")?></li>
      <li class="check3"><?=___("Покажи им могућности <a href='/en-US/firefox/central' target='_top'>на свом рачнару</a> или им покажи <a href='/en-US/firefox/video/' target=/_top'>видео снимак</a>.")?></li>
    </ul>
  </section>
  
  <section class="step" id="step4">
    <h2><?=___("AWESOME = YOU!")?></h2>
    <p><?=___("Give yourself a pat on the back. You helped someone get the best of the Web and make sure it stays open and awesome. Let's keep building a better Web together.")?></p>
  
    <div id="share">
      <h3><?=___("I upgraded a friend to Firefox 4!")?></h3>
      <ul>
        <li><a id="share-twitter" title="Share on Twitter" href="https://twitter.com/home/?status=Discover%20the%20awesome.%20I%20did!%20Upgrade%20to%20Firefox%204%20today!%20http://mzl.la/i85nib%20%23fx4"><?=___('Twitter')?></a></li>
        <li><a id="share-facebook" title="Share on Facebook" href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Fmzl.la%2Fi85nib&amp;t=Discover%20the%20awesome.%20I%20did!%20Upgrade%20to%20Firefox%204%20today!"><?=___('Facebook')?></a></li>
        <li><a id="share-email" title="Share by email" href="#email-box"><?=___('Email')?></a></li>
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
    include_once "{$config['file_root']}/{$lang}/includes/l10n/webhero-emailbox.html";
    echo $stats_js; 
    include_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
