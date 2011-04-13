<?php
    // The $body_* variables are for compatibility with pre-existing css
    $page_title = 'About Mozilla';
    
    $pageid = 'about';
    require_once "{$config['file_root']}/includes/l10n/controller.inc.php";
?>

<div id="main-feature">
    <h2>Bom para a Web.<br />Bom para o Mundo.</h2>
</div>

<div id="content">

<p>A Mozilla não é uma companhia de software tradicional. Somos uma <a href="/<?=$lang?>/firefox/community/">comunidade</a> global dedicada à construção de produtos de software de código aberto grátis e de tecnologias que aumentam a experiência online de todas as pessoas. somos programadores, marketers, testers, e advogados de todo o mundo que trabalham para assegurar que a Web se mantém aberta e pública à partilha de recursos. Acreditamos que standards abertos aumentam e melhoram a escolha e a inovação para todos tornando em qualquer local a experiência online mais segura e rápida.</p>

<p>Os nossos, <a href="/<?=$lang?>/products/">produtos de software</a> de código aberto e <a href="http://www.mozilla.org/projects/">tecnologias</a> premiadas são oferecidas gratuitamente a todos em mais de 40 idiomas.</p>

<p>A Mozilla tem a sua sede em <a href="/<?=$lang?>/about/contact.html">Mountain View, California</a> com escritórios regionais em <a href="/<?=$lang?>/about/contact.html">Auckland</a>, <a href="/<?=$lang?>/about/contact.html">Beijing</a>, <a href="/<?=$lang?>/about/contact.html">Copenhagen</a>, <a href="/<?=$lang?>/about/contact.html">Paris</a>, <a href="/<?=$lang?>/about/contact.html">Tokyo</a> e <a href="/<?=$lang?>/about/contact.html">Toronto</a>.</p>

</div>

<?php
    include_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
