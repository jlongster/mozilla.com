<?php

$body_id    = 'firefoxflicks-brief';

// commodity functions for localized pages
require_once $config['file_root'].'/includes/l10n/toolbox.inc.php';

// temporary include to parallelize webdev and l10n- webdev work on the project
require_once $config['file_root'].'/includes/l10n/firefoxflicks-helper.inc.php';

require_once $config['file_root'].'/includes/l10n/header-firefoxflicks.inc.php';

?>

    <section id="primary"><div class="container">
    <? require_once $config['file_root'].'/'.$lang.'/firefoxflicks/brief/content.inc.html'; ?>
    </div></section>

<?
require_once $config['file_root'].'/includes/l10n/footer-firefoxflicks.inc.php';
?>

