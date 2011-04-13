<?php
    // The $body_* variables are for compatibility with pre-existing css
    $page_title = 'Om Mozilla';
    
    $pageid = 'about';
    require_once "{$config['file_root']}/includes/l10n/controller.inc.php";
?>

<div id="main-feature">
    <h2>Godt for nettet.<br />Godt for verden.</h2>
</div>

<div id="content">

<p>Mozilla er ikke en traditionel softwarevirksomhed. Vi er et dedikeret, globalt <a href="/<?=$lang?>/firefox/community/">fællesskab</a>, der laver frie, Open Source softwareprodukter og teknologier, der forbedrer brugen af internettet i hele verden. Vi er programmører, marketingfolk, testere og fortalere fra alle egne af kloden, som arbejder for at sikre, at nettet forbliver en delt, offentlig og åben ressource. Vi tror på, at åbne standarder muliggør og fremskynder valgfrihed og innovation, og at alle - uanset hvor i verden de befinder sig - er berettiget til den sikreste, hurtigste og bedste oplevelse af internettet.</p>

<p>Vores prisvindende Open Source <a href="/<?=$lang?>/products/">programmer</a> og <a href="http://www.mozilla.org/projects/">teknologier</a> tilbydes gratis på flere end 40 sprog.</p>

<p>Mozilla har hovedsæde i <a href="/<?=$lang?>/about/contact.html">Mountain View, Californien</a> med regionale kontorer i <a href="/<?=$lang?>/about/contact.html">Auckland</a>, <a href="/<?=$lang?>/about/contact.html">Beijing</a>, <a href="/<?=$lang?>/about/contact.html">København</a>, <a href="/<?=$lang?>/about/contact.html">Paris</a>, <a href="/<?=$lang?>/about/contact.html">Tokyo</a> og <a href="/<?=$lang?>/about/contact.html">Toronto</a>.</p>

<p><a href="http://mozilladanmark.dk/">MozillaDanmark</a> står for oversættelsen af Mozillas programmer til dansk og for koordinering af <a href="http://www.mozilladanmark.dk/faahjaelp/">brugersupport</a> på dansk.</p>

</div>

<?php
    include_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
