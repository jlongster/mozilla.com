
<div id="main-feature">
    <h2><?php e__('Made for sharing'); ?></h2>

    <ul id="benefits">
        <li class="first"><?php e__('Create <span>dedicated</span> <span>tabs for it</span>'); ?></li>
        <li><?php e__('Customize <span>to make</span> <span>it faster</span>'); ?></li>
        <li><?php e__('Get add-ons <span>and make</span> <span>it easier</span>'); ?></li>
    </ul>


    <?=buildPlatformImage($config['static_prefix'].'/img/covehead/firefox/direct/social-facebook.png', 'Firefox screenshot', null, null, 'screenshot second-screenshot', array('mac', 'linux'))?>
    <?=buildPlatformImage($config['static_prefix'].'/img/covehead/firefox/direct/social-twitter.png', 'Firefox screenshot', null, null, 'screenshot', array('mac', 'linux'))?>

<?=$downloadbox?>
<p id="mobile-promo"></p>

</div>
<hr class="hide" />

<?php

require_once $config['file_root'].'/includes/l10n/marketing/home.lowerpage.inc.php';

?>
