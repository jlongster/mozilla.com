<?php
    // The $body_* variables are for compatibility with pre-existing css
    $page_title = 'За Mozilla';
    
    $pageid = 'about';
    require_once "{$config['file_root']}/includes/l10n/controller.inc.php";
?>

<div id="main-feature">
    <h2>Добро за Мрежата.<br />Добро за света.</h2>
</div>

<div id="content">

<p>Mozilla не е традиционна софтуерна фирма. Ние сме глобална <a href="/<?=$lang?>/firefox/community/">общност</a>, отдадена на създаването на свободни (и с отворен код) софтуерни продукти и технологии, които да подобряват работата онлайн на всички хора по света. Ние сме програмисти, търговци, тестери и адвокати от целия свят, които работим за осигуряването на Мрежата като отворен споделен публичен ресурс. Ние вярваме, че отворените стандарти включват и засилват избора и иновациите и че всеки навсякъде трябва да има най-безопасно, най-бързо и възможно най-добро присъствие онлайн.</p>

<p>Нашите награждавани <a href="/<?=$lang?>/products/">софтуерни продукти</a> и <a href="http://www.mozilla.org/projects/">технологии</a> с отворен код се предлагат безплатно на хората навсякъде, на повече от 40 езика.</p>

<p>Mozilla е със седалище <a href="/<?=$lang?>/about/contact.html">Маунтън Вю (Калифорния)</a>, с регионални офиси в <a href="/<?=$lang?>/about/contact.html">Окланд</a>, <a href="/<?=$lang?>/about/contact.html">Пекин</a>, <a href="/<?=$lang?>/about/contact.html">Копенхаген</a>, <a href="/<?=$lang?>/about/contact.html">Париж</a>, <a href="/<?=$lang?>/about/contact.html">Токио</a> и <a href="/<?=$lang?>/about/contact.html">Торонто</a>.</p>

</div>

<?php
    include_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
