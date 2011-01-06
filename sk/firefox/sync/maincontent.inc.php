<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Synchronizujte svoje inštalácie Firefoxu</h2>
    <p>Pristupujte k svojej histórii, heslám, záložkám či otvoreným kartám zo všetkých svojich zariadení.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Nainštalovať doplnok Firefox Sync</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>Prečo synchronizovať?</h3>

    <h4>Jednoducho sa postavte a môžete ísť</h4>
    <p>Vyhľadávate niečo v práci a zistíte, že je čas ísť domov? Teraz sa môžete dostať k svojim otvoreným kartám a histórii vyhľadávania z ktoréhokoľvek počítača. Váš Firefox je presne taký, ako ste ho zanechali. Pritom nezáleží na tom, kde sa prihlásite.</p>

    <h4>Zálohujte si svoje údaje</h4>
    <p>Všetky vaše nastavenia, heslá, záložky a ďalšie prispôsobenia sú uložené vzdialene a teda nie sú previazané s jedným zariadením. Ak zariadenie vymeníte, nestratíte svoj Firefox.</p>

    <h4>Bezpečnosť</h4>
    <p>Vaše informácie sú zašifrované, takže k nim môžete pristupovať len vy, keď zadáte svoju tajnú frázu. Pre Firefox je bezpečnosť najvyššou prioritou, pri synchronizácií nevynímajúc.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">Ďalšie informácie o doplnku Firefox Sync vo vašom mobilnom telefóne.</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Ako začať</h3>
    <ol>
        <li>Nainštalujte si doplnok <a href="<?=$amo_url?>">Firefox Sync</a>.</li>
        <li>Reštartujte Firefox a podľa zobrazených pokynov si vytvorte účet s heslom a tajnou frázou.</li>
        <li>Nainštalujte si doplnok Firefox Sync na všetkých zariadeniach, ktoré používate.</li>
        <li>Prihláste sa, zvoľte, čo chcete synchronizovať a môžete začať s prehliadaním tam, kde ste skončili.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Často kladené otázky</a></p>


    <?php echo $download_box; ?>
</div>
