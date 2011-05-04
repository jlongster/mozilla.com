
<div id="main-feature">
    <h2><?php e__('Made for sharing.'); ?></h2>

    <ul id="benefits">
        <li class="first"><?php e__('Create <br/> dedicated <br/> tabs for it'); ?></li>
        <li><?php e__('Customize <br/> to make <br/> it faster'); ?></li>
        <li><?php e__('Get add-ons <br/> and make <br/> it easier'); ?></li>
    </ul>


    <?=buildPlatformImage($config['static_prefix'].'/img/covehead/firefox/direct/social-facebook.png', 'Firefox screenshot', null, null, 'screenshot second-screenshot', array('mac', 'linux'))?>
    <?=buildPlatformImage($config['static_prefix'].'/img/covehead/firefox/direct/social-twitter.png', 'Firefox screenshot', null, null, 'screenshot', array('mac', 'linux'))?>

<?=$downloadbox?>
    <p id="mobile-promo">
      <a href="/<?=$lang?>/mobile/?WT.mc_id=hp_1&amp;WT.mc_ev=click"
         onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.com',
                                'DCS.dcsuri', '/<?=$lang?>/mobile/',
                                'WT.ti', 'Link: Get Firefox on your phone!',
                                'WT.dl', 99,
                                'WT.nv', 'Content',
                                'WT.ac', 'Mobile');"><?php e__('Get Firefox on your phone!');?></a>
    </p>

</div>
<hr class="hide" />

<?php

require_once $config['file_root'].'/includes/l10n/marketing/home.lowerpage.inc.php';

?>

