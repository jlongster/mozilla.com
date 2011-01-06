<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Mantente sincronizado en tus Firefox</h2>
    <p>Accede a tu historial, contraseñas, marcadores y hasta las pestañas que tienes abiertas en todos tus dispositivos.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Descarga el complemento Firefox Sync gratuitamente</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>¿Por qué sincronizar?</h3>

    <h4>Listo para llevar</h4>
    <p>¿Estabas realizando una búsqueda en el trabajo y te diste cuenta que era hora de ir a casa? Ahora puedes volver a las pestañas que tenías abiertas y el historial de búsqueda de forma instantánea desde cualquier PC. Tu Firefox como lo dejaste, sin importar dónde estés.</p>

    <h4>Un respaldo de tu información</h4>
    <p>Todas tus configuraciones, contraseñas, marcadores y otras modificaciones se guardan para todos tus equipos, no encadenado a una sola máquina. Si cambias un dispositivo, no pierdes tu Firefox.</p>

    <h4>Seguridad</h4>
    <p>Tu información está cifrada para que sólo tú puedas acceder a ella cuando ingresas tu frase secreta. La seguridad es una de las prioridades principales de Firefox y la sincronización no es una excepción.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">Más información sobre Firefox Sync en tú teléfono.</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Cómo empezar</h3>
    <ol>
        <li>Instala el <a href="<?=$amo_url?>">complemento Firefox Sync</a> gratuitamente.</li>
        <li>Reinicia Firefox y sigue los pasos para crear una cuenta que incluye tanto una contraseña como una frase secreta.</li>
        <li>Instala Firefox Sync en los demás dispositivos que uses.</li>
        <li>Ingresa y elije cómo sincronizar, luego comienza a navegar donde lo habías dejado.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Preguntas frecuentes</a></p>


    <?php echo $download_box; ?>
</div>
