<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Stay in Sync With Your Firefox</h2>
    <p>Access your history, passwords, bookmarks and even open tabs across all your devices.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Get the Free Firefox Sync Add-on Now</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>Why Sync Up?</h3>

    <h4>Get Up and Go</h4>
    <p>Doing online research from the office, only to see itʼs time to head home? Now you can go back to your opened tabs and search history in an instant from any PC. Your Firefox is as you left it, no matter where you log in.</p>

    <h4>Backup Your Info</h4>
    <p>All your settings, passwords, bookmarks, and other customizations are saved in a more universal way, not tethered to a single machine. If you replace a device, you donʼt lose your Firefox.</p>

    <h4>Security</h4>
    <p>Your information is encrypted so only you can access it when you enter a Secret Phrase. Firefox puts security as a top priority and syncing is no exception.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">Learn about Firefox Sync on your phone.</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Getting Started</h3>
    <ol>
        <li>Install the free <a href="<?=$amo_url?>">Firefox Sync Add-on</a>.</li>
        <li>Restart Firefox and follow prompts to create an account with both a password and a Secret Phrase.</li>
        <li>Install Firefox Sync on all the other devices you use.</li>
        <li>Sign-in and choose how to sync, then start browsing where you left off.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Frequently Asked Questions</a></p>


    <?php echo $download_box; ?>
</div>
