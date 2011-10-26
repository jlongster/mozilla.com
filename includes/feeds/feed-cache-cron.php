#!/usr/bin/php
<?php

require_once dirname(__FILE__) . '/../config.inc.php';
require_once dirname(__FILE__) . '/../langconfig.inc.php';
require_once dirname(__FILE__) . '/FeedCacheCron.php';

$cron = new FeedCacheCron(
    dirname(__FILE__) . '/cron-config.ini'
);

$cron->run();

?>
