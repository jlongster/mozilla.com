<?php


if (is_numeric($downloads)) {
    $windowmessage = '
    <div id="download-stats">
        <h3 style="float:left; font-size:1.3em;vertical-align:middle;margin:0; height:100px; text-align:center; line-height:25px;padding:25px 0;">Rejoignez<br/>nous</h3>
        <p style="text-align:center; font-weight:normal; line-height:30px;height:auto;">
            Déjà <span id="download-count" style="color: #6FB02B;">'.$downloads.'</span> téléchargements
        </p>
    </div>';
} else {
    $windowmessage = '
    <div id="download-stats">
        <span id="download-count">Déjà des millions de téléchargements</span>
    </div>';
}


?>

<div id="main-feature">
    <h2>Conçu pour rendre<br/>le Web meilleur</h2>

    <?php if($promo): ?>
    <ul id="benefits">
        <li class="first"><?php echo $str4 ?></li>
        <li><?php echo $str5 ?></li>
        <li><?php echo $str6 ?></li>
    </ul>
    <?php else: ?>
    <hr style="margin-bottom:3em; height:0; border:0; color:transparent; background-color:transparent">
    <?php endif; ?>

    <div id="screenshot">
    <?=buildPlatformImage($config['static_prefix'].'/img/l10n/main-feature.png', 'Firefox screenshot', null, null, 'screenshot', array('mac', 'linux'))?>

        <?=$windowmessage;?>
    </div>

<?=$downloadbox?>

<p id="mobile-promo"><a href="./mobile/">Découvrez Firefox sur votre mobile</a></p>

</div>

<div id="main-content">

    <div class="sub-feature first" id="sub-firefox">
        <h3>Visite guidée</h3>
        <p><a id="tour-link" href="./features/">Découvrez un aperçu des nouveautés de Firefox&nbsp;4</a>
        </p>
    </div>

    <div class="sub-feature">
        <h3>Personnalisation</h3>
        <p>À chacun son navigateur
        <a href="https://addons.mozilla.org/"><?php e__('Learn More');?></a>
        </p>
    </div>

    <div class="sub-feature">
        <h3>Rapidité</h3>
        <p>Donnez un coup d'accélérateur à votre navigation sur le Web
        <a href="./features/#super-speed"><?php e__('Learn More');?></a>
        </p>
    </div>

    <div class="sub-feature">
        <h3>Sécurité</h3>
        <p>Nous protégeons votre ordinateur et vos données personnelles
        <a href="./features/#advancedsecurity"><?php e__('Learn More');?></a>
        </p>
    </div>

</div>




