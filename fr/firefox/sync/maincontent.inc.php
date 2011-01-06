<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Restez en phase avec votre Firefox</h2>
    <p>Accédez à vos mots de passe, historique, marque-pages et même vos onglets ouverts d'un appareil à l'autre.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Obtenez tout de suite, gratuitement, Firefox Sync</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>Pourquoi se synchroniser&nbsp;?</h3>

    <h4>Changez de poste</h4>
    <p>Vous faites une recherche en ligne depuis le bureau pour vous apercevoir qu'il est l'heure de rentrer&nbsp;? Maintenant vous pouvez retrouver vos onglets ouverts et parcourir votre historique depuis n'importe quel PC. Votre Firefox est tel que vous l'avez laissé quel que soit l'endroit d'où vous vous connectez.</p>

    <h4>Sauvegardez vos informations</h4>
    <p>Tous vos paramètres, mots de passe, marque-pages et autre personnalisation sont sauvegardés de façon plus universelle et non pas liés à une machine unique. Si vous remplacez un appareil, vous ne perdrez pas votre Firefox.</p>

    <h4>Sécurité</h4>
    <p>Vos informations sont chiffrées afin que vous seul puissiez y accéder grâce à votre phrase secrète. Firefox place la sécurité comme une priorité principale et la synchronisation n'y fait pas exception.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">En apprendre plus sur Firefox Sync pour votre téléphone.</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Démarrer</h3>
    <ol>
        <li>Installez gratuitement <a href="<?=$amo_url?>">Firefox Sync</a>.</li>
        <li>Redémarrez Firefox et suivez les indications pour créer un compte avec un mot de passe et une phrase secrète.</li>
        <li>Installez Firefox Sync sur tous les autres appareils que vous utilisez.</li>
        <li>Enregistrez-vous et choisissez les informations à synchroniser, puis reprenez la navigation où vous l'aviez interrompue.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Foire aux questions</a></p>


    <?php echo $download_box; ?>
</div>
