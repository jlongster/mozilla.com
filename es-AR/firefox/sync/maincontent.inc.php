<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Sincronizate con Firefox</h2>
    <p>Accedé a tu historial, contraseñas, marcadores y hasta las pestañas que están abiertas en todos tus dispositivos.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Descargá gratis el agregado Firefox Sync</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>¿Por qué sincronizar?</h3>

    <h4>Levántate y anda</h4>
    <p>¿Estabas realizando una búsqueda en el trabajo y te diste cuenta que era hora de ir a casa? Ahora podés volver a las pestañas que tenías abiertas y el historial de búsqueda de forma instantánea desde cualquier PC. Tu Firefox como lo dejaste, sin importar dónde estés.</p>

    <h4>Un respaldo de tu información</h4>
    <p>Todas tus configuraciones, contraseñas, marcadores y otras modificaciones se guardan para todos tus equipos, no encadenados a una sola máquina. Si cambiás un dispositivo, no perdés tu Firefox.</p>

    <h4>Seguridad</h4>
    <p>Tu información está cifrada para que sólo vos puedas acceder a ella cuando escribís tu frase secreta. La seguridad es una de las prioridades principales de Firefox y la sincronización no es una excepción.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">Conocé sobre Firefox Sync en tú teléfono.</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Cómo empezar</h3>
    <ol>
        <li>Instalá gratis el <a href="<?=$amo_url?>">agregado Firefox Sync</a> .</li>
        <li>Reiniciá Firefox y seguí los pasos para crear una cuenta que incluye tanto una contraseña como una frase secreta.</li>
        <li>Instalá Firefox Sync en los demás dispositivos que uses.</li>
        <li>Ingresá y elije cómo sincronizar, luego comenzá a navegar donde habías dejado.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Preguntas frecuentes</a></p>


    <?php echo $download_box; ?>
</div>
