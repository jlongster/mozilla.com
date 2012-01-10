<?php

$wurfl['main-file'] = "wurfl-latest.xml";

$persistence['provider'] = "file";
$persistence['dir'] = "/tmp";

$cache['provider'] = "file";
$cache['dir'] = "/var/www/mozilla/tmp";

$configuration["wurfl"] = $wurfl;
$configuration["persistence"] = $persistence;
$configuration["cache"] = $cache;

?>
