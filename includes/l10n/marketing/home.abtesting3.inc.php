<?php


if ($download_ok ==  true) {
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

$footerfile = $config['file_root'] . '/includes/l10n/marketing/home.abtesting3.footer.inc.php';

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




