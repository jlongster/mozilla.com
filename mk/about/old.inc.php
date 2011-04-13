<?php
    // The $body_* variables are for compatibility with pre-existing css
    $page_title = 'About Mozilla';
    
    $pageid = 'about';
    require_once "{$config['file_root']}/includes/l10n/controller.inc.php";
?>

<div id="main-feature">
    <h2>Добро за мрежата.<br />Добро за светот.</h2>
</div>

<div id="content">

    <p>Mozilla не е традиционална софтверска компанија. Ние сме глобална
    <a href="/<?=$lang?>/firefox/community/">заедница</a> посветена на создавање на производи
    и технологии кои се слободен софтвер и кои го подобруваат искуството
    кое луѓето насекаде го имаат на Интернет. Ние сме програмери, продавачи, тестери и промотери
    од целиот свет кои работат со цел мрежата да остане отворен, заеднички и јавен ресурс. Веруваме
    дека отворените стандарди даваат избор и овозможуваат иновации и дека секому, секаде, му следува
    најбезбедно, најбрзо и најдобро можно искуство на Интернет.</a>


    <p>Нашите наградувани слободни <a href="/<?=$lang ?>/products/">софтверски производи</a>  и <a href="http://www.mozilla.org/projects/">технологии</a> им се нудат
    бесплатно на сите луѓе во повеќе од 40 јазици.</p>

   <p>Дирекцијата на Mozilla е во <a href="/<?=$lang ?>/about/contact.html#hq">Маунтин Вју,
    Калифорнија</a>, а регионални канцеларии има во <a href="/<?=$lang?>/about/contact.html">Оукленд</a>, <a href="/<?=$lang?>/about/contact.html">Пекинг</a>, <a href="/<?=$lang?>/about/contact.html">Копенхаген</a>, <a href="/<?=$lang ?>/about/contact.html#japan"> Токио</a>, <a href="/<?=$lang?>/about/contact.html">Торонто</a> и
   <a href="/<?=$lang ?>/about/contact.html#europe"> Париз</a>.</p>

</div>

<?php
    include_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
