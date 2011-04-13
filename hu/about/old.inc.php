<?php
    // The $body_* variables are for compatibility with pre-existing css
    $page_title = 'Bemutatkozás';
    
    $pageid = 'about';
    require_once "{$config['file_root']}/includes/l10n/controller.inc.php";
?>

<div id="main-feature">
    <h2>Az internet sikere, <br />mindannyiunk sikere!</h2>
</div>

<div id="content">

<p>A Mozilla nem egy szokványos szoftvercég. A Mozilla egy világméretű, <a href="/<?=$lang?>/firefox/community/">közösséget</a> alkot, amelynek célja ingyenes, nyílt forráskódú szoftverek és technológiák fejlesztésén keresztül fokozni az internetezés élményét az emberek számára. Programozók, elemzők, tesztelők és a projekt támogatói, a világ minden táján azon dolgoznak, hogy az internet egy nyílt, közösségi hely maradjon. Bízunk benne, hogy a nyílt szabványok lehetővé teszik és elősegítik a választás lehetőségét, az innovációt, valamint hogy bárkinek, bárhol lehetősége legyen elérni a legbiztonságosabb, leggyorsabb és az internetezés lehető legnagyobb élményét.</p>

<p>A díjnyertes, nyílt forráskódú <a href="/<?=$lang?>/products/">termékek</a> és <a href="http://www.mozilla.org/projects/">technológiák</a> több mint 40 nyelven, mindenki számára, szabadon elérhetők.</p>

<p>A Mozilla központja <a href="/<?=$lang?>/about/contact.html">Mountain View városában, Kaliforniában</a> található és regionális irodái vannak <a href="/<?=$lang?>/about/contact.html">Aucklandben</a>, <a href="/<?=$lang?>/about/contact.html">Pekingben</a>, <a href="/<?=$lang?>/about/contact.html">Koppenhágában</a>, <a href="/<?=$lang?>/about/contact.html">Párizsban</a>, <a href="/<?=$lang?>/about/contact.html">Tokióban</a> és <a href="/<?=$lang?>/about/contact.html">Torontoban</a>.</p>

</div>

<?php
    include_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
