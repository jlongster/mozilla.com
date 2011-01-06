<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Sincronizza il tuo Firefox</h2>
    <p>Accedi da tutti i tuoi dispositivi a cronologia, password, segnalibri e perfino schede aperte.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Installa ora il componente aggiuntivo gratuito Firefox Sync</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>Perché sincronizzare?</h3>

    <h4>Alzati e vai</h4>
    <p>Stai completando delle ricerche dall'ufficio e ti accorgi che è ora di tornare a casa? Ora puoi ripristinare in un attimo le schede aperte e la cronologia di ricerca su qualsiasi computer. Ritroverai Firefox così come l'hai lasciato, non importa da dove accedi.</p>

    <h4>Salva i tuoi dati</h4>
    <p>Impostazioni, password, segnalibri e altre personalizzazioni vengono salvati in modo più universale e non sono più legati alla singola macchina. Se sostituisci un dispositivo, non perdi il tuo Firefox.</p>

    <h4>Sicurezza</h4>
    <p>I tuoi dati sono cifrati e solo tu potrai accedervi utilizzando una frase segreta. Firefox considera la sicurezza una priorità fondamentale e la sincronizzazione non fa eccezione.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">Scopri ulteriori informazioni su Firefox Sync per il tuo telefono cellulare.</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Per iniziare</h3>
    <ol>
        <li>Installa il componente aggiuntivo gratuito <a href="<?=$amo_url?>">Firefox Sync</a>.</li>
        <li>Riavvia Firefox e segui le indicazioni per creare un account con password e frase segreta.</li>
        <li>Installa Firefox Sync su tutti i dispositivi che utilizzi.</li>
        <li>Accedi e scegli come sincronizzare, poi ricomincia a navigare da dove avevi interrotto.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Domande più frequenti</a></p>


    <?php echo $download_box; ?>
</div>
