<?php
    // translate $page_title below
    $page_title = 'Acerca de Mozilla';


    $pageid = 'about';
    require_once "{$config['file_root']}/includes/l10n/controller.inc.php";
?>


<div id="main-feature">
    <h2>
    Bueno para la Web.
    <br />
    Bueno para el Mundo.
    </h2>
</div>

<div id="content">

<p>Mozilla no es una empresa tradicional de software. Somos una <a href="/<?=$lang?>/firefox/community/">comunidad</a> global dedicada a construir productos de software libres, de código abierto y tecnologías que mejoran la experiencia en línea para gente de todos los rincones del mundo. Somos programadores, publicistas, probadores y activistas de todo el mundo que trabajamos para asegurar que la Web siga siendo un recurso público, compartido y abierto. Creemos que los estándares abiertos permiten y fortalecen las opciones y la innovación y que cualquier persona, en cualquier lugar del mundo, tiene derecho a la mejor, más rápida y segura experiencia en Internet posible.</p>

<p>Nuestros premiados <a href="/<?=$lang?>/products/">productos de software</a> y <a href="http://www.mozilla.org/projects/">tecnologías</a> de código abierto se ofrecen sin costo alguno a todo el mundo en más de 70 idiomas.</p>

<p>Mozilla tiene su casa matriz en <a href="/<?=$lang?>/about/contact.html">Mountain View, California</a> con <a href="/<?=$lang?>/about/contact.html">sucursales regionales</a> en Auckland, Beijing, Copenhagen, Paris, Tokio y Toronto.</p>

</div>



<?php
    include_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
