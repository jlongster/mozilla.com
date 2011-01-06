<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Sincronitzeu-vos amb el vostre Firefox</h2>
    <p>Accediu a l'historial, contrasenyes, adreces d'interès i fins i tot a les pestanyes obertes de tots els vostres dispositius.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Feu-vos ara amb el complement Firefox Sync</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>Per què sincronitzar-vos?</h3>

    <h4>Aixequeu-vos i marxeu</h4>
    <p>Estàveu fent alguna cerca en línia des de l'oficina i heu vist que era hora de tornar a casa? Ara podeu recuperar les vostres pestanyes obertes i l'historial de cerca en qualsevol moment i des de qualsevol ordinador. El vostre Firefox està tal com el vau deixar, sense importar des d'on inicieu la sessió.</p>

    <h4>Protegiu la vostra informació</h4>
    <p>La vostra configuració, contrasenyes, adreces d'interès i altres personalitzacions es desen d'una manera més universal, no aferrades a un sol equip. Si reemplaceu un dispositiu, no perdeu el vostre Firefox.</p>

    <h4>Seguretat</h4>
    <p>La vostra informació s'encripta i només hi podeu accedir quan introduïu la frase secreta. Cap altra persona no pot veure-la. La prioritat més gran del Firefox és la seguretat i la sincronització no és una excepció.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">Més informació sobre el Firefox Sync al mòbil.</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Primers passos</h3>
    <ol>
        <li>Instal·leu el <a href="<?=$amo_url?>">Complement Firefox Sync</a> gratuïtament.</li>
        <li>Reinicieu el Firefox i seguiu les instruccions per crear un compte amb contrasenya i frase secreta.</li>
        <li>Instal·leu el Firefox Sync en tots els altres dispositius que feu servir.</li>
        <li>Inicieu la sessió i escolliu com sincronitzar. Just després ja podreu començar a navegar des d'on us havíeu quedat.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Preguntes més freqüents</a></p>


    <?php echo $download_box; ?>
</div>
