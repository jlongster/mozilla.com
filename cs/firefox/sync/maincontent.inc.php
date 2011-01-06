<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Synchronizace instalací Firefoxu</h2>
    <p>Přistupujte ke společné historii, heslům, záložkám či otevřeným panelům na všech svých zařízeních.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Získat zdarma doplněk Firefox Sync</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>Proč synchronizovat?</h3>

    <h4>Rychlá dostupnost</h4>
    <p>Vyhledáváte něco v práci a zjistíte, že je čas jít domů? Nyní máte možnost získat své otevřené panely či vyhledávat v historii z kteréhokoliv počítače. Váš Firefox je všude stejný. Nezáleží na tom, kde se přihlásíte.</p>

    <h4>Záloha vašich dat</h4>
    <p>Všechna vaše nastavení, hesla, záložky a ostatní úpravy jsou uloženy vzdáleně a nejsou tak vázány pouze na jedno zařízení. Pokud jej vyměníte za jiné, svůj Firefox neztratíte.</p>

    <h4>Bezpečnost</h4>
    <p>Vaše informace jsou šifrovány a můžete k ním přistoupit pouze při znalosti tajné fráze. Firefox si klade bezpečnost jako nejvyšší prioritu a synchronizace není výjimkou.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">Dozvědět se více o Firefox Sync pro mobilní zařízení</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Jak začít</h3>
    <ol>
        <li>Nainstalujte si zdarma <a href="<?=$amo_url?>">doplněk Firefox Sync</a>.</li>
        <li>Restartujte Firefox a podle zobrazených instrukcí si vytvořte účet s heslem a tajnou frází.</li>
        <li>Nainstalujte Firefox Sync na všech zařízeních, která používáte.</li>
        <li>Přihlašte se, zvolte si způsob synchronizace a začněte s prohlížením tam, kde jste přestali.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Často kladené otázky</a></p>


    <?php echo $download_box; ?>
</div>
