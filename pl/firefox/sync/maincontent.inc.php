<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Synchronizuj swojego Firefoksa</h2>
    <p>Dostęp do historii przeglądania, haseł, zakładek, a nawet otwartych kart na wszystkich Twoich urządzeniach.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Pobierz Firefox Sync</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>Po co synchronizować?</h3>

    <h4>Wstań i idź</h4>
    <p>Przeszukujesz Internet, będąc w biurze tylko po to, by po powrocie do domu, zobaczyć ile czasu Ci to zajęło? Teraz możesz wrócić do swoich otwartych kart i historii przeglądania w jednej chwili z dowolnego komputera. Twój Firefox jest w takim stanie, w jakim został pozostawiony, bez względu na to gdzie nastąpiło wylogowanie.</p>

    <h4>Tworzenie kopii zapasowej informacji</h4>
    <p>Wszystkie Twoje ustawienia, hasła, zakładki i inne elementy są zapisywane w najbardziej uniwersalny sposób, nie ograniczony tylko do jednego urządzenia. Jeśli zmienisz urządzenie, nie stracisz ustawień swojego Firefoksa.</p>

    <h4>Bezpieczeństwo</h4>
    <p>Twoje informacje są szyfrowane, tak więc tylko Ty, po podaniu szyfru, masz do nich dostęp. Firefox traktuje bezpieczeństwo jako najwyższy priorytet i synchronizacja nie jest tutaj wyjątkiem.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">Dowiedz się więcej o Firefox Sync zainstalowanym w Twoim telefonie.</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Pierwsze kroki</h3>
    <ol>
        <li>Zainstaluj dodatek <a href="<?=$amo_url?>">Firefox Sync</a>.</li>
        <li>Uruchom ponownie Firefoksa i utwórz konto podając swoje hasło i szyfr.</li>
        <li>Zainstaluj Firefox Sync na wszystkich swoich używanych urządzeniach.</li>
        <li>Zaloguj się, wybierz metodę synchronizacji i wróć do przeglądania Internetu.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Często zadawane pytania</a></p>


    <?php echo $download_box; ?>
</div>
