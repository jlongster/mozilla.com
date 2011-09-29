#!/usr/bin/php
<?php

require_once dirname(__FILE__) . '/../config.inc.php';
require_once dirname(__FILE__) . '/../langconfig.inc.php';
require_once dirname(__FILE__) . '/FeedCacheCron.php';

$cron = new FeedCacheCron(
    $config['file_root'] . '/includes/feeds/cron-config.ini'
);

$cron->setVerbose(true);
$cron->run();

?>
