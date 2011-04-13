<?php
   // The $body_* variables are for compatibility with pre-existing css
   // the $page_title string should be translated
   $page_title = 'A prepaus de Mozilla';
    
    $pageid = 'about';
    require_once "{$config['file_root']}/includes/l10n/controller.inc.php";
?>

<div id="main-feature">
   <h2>Bon pel web.<br />Plan pel mond.</h2>
</div>

<div id="content">

<p>Mozilla es pas una entrepresa de logicials tradicionala. Sèm una <a href="/<?=$lang?>/firefox/community/">communautat</a> mondiala que se dedica al desvolopament de logicials e de tecnologias a gratís e luires que melhoran la vida en linha d'utilizaires pertot dins lo mond. Sèm de programaires, de comercials, de testaires e d'!!avocats del mond entièr que trabalham per nos assegurar que lo web demòra una ressorga publica dobèrta e partejada. Cresèm que las nòrmas dobèrtas permeton e melhoran la causida e l'inovacion e que qual que siá, ont que siá, a lo drech d'utilizar los espleches melhors, pus segurs e pus rapids.</p>

<p>Nòstres <a href="/<?=$lang?>/products/">produches logicials</a> ganhèron de prèmis e son liures. Lor <a href="http://www.mozilla.org/projects/">tecnologia</a> son ofèrtas a gratis a totes dins mai de 40 lengas.</p>

<p>Lo seti de Mozilla es a <a href="/<?=$lang?>/about/contact.html">Mountain View, California</a>, amb de burèus regionals a <a href="/<?=$lang?>/about/contact.html">Auckland</a>, <a href="/<?=$lang?>/about/contact.html">Pequin</a>, <a href="/<?=$lang?>/about/contact.html">Copenaga</a>, <a href="/<?=$lang?>/about/contact.html">París</a>, <a href="/<?=$lang?>/about/contact.html">Tòquio</a> e <a href="/<?=$lang?>/about/contact.html">Toronto</a>.</p>

</div>

<?php
    include_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
