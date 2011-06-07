<?php

if ($download_ok ==  true) {
    $windowmessage = '
    <div id="download-stats" style="text-align:center; font-weight:normal; font-size:2em; left:90px;top:250px;">
        Déjà
        <span id="download-count">'.$downloads.'</span>
        téléchargements
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
        <li><em>&raquo;</em><?php echo $str4 ?></li>
        <li><em>&raquo;</em><?php echo $str5 ?></li>
        <li><em>&raquo;</em><?php echo $str6 ?></li>
    </ul>
    <?php else: ?>
    <hr style="margin-bottom:3em; height:0; border:0; color:transparent; background-color:transparent">
    <?php endif; ?>

    <div id="screenshot">
    <?=buildPlatformImage($config['static_prefix'].'/img/l10n/main-feature.png', 'Firefox screenshot', null, null, 'screenshot', array('mac', 'linux'))?>

        <?=$windowmessage;?>
    </div>

<?=$downloadbox?>

</div>

<div id="main-content">

    <div class="sub-feature first">
        <h3>Personnalisation</h3>
        <p>Découvrez les nouveautés de Firefox&nbsp;4
        <a href="./features/"><?php e__('Learn More');?></a></p>
    </div>

    <div class="sub-feature">
        <h3>Rapidité</h3>
        <p>Firefox&nbsp;4 est jusqu'à 6&nbsp;fois plus rapide que la version précédente
        <a href="./features/#super-speed"><?php e__('Learn More');?></a>
        </p>
    </div>

    <div class="sub-feature">
        <h3>Sécurité</h3>
        <p>Firefox&nbsp;4 protège votre ordinateur et vos données personnelles
        <a href="./features/#advancedsecurity"><?php e__('Learn More');?></a>
        </p>
    </div>

</div>




