<?php
// Basic version of the prefetch file for sites on another domain
// eg: itisatrap.org

// Load our config
require dirname(__FILE__).'/config.inc.php';

// Load our language config
require dirname(__FILE__).'/langconfig.inc.php';


// Load the product details classes
require dirname(__FILE__).'/product-details/firefoxDetails.class.php';
require dirname(__FILE__).'/product-details/thunderbirdDetails.class.php';

// Load our migrated over functions
require dirname(__FILE__).'/functions.inc.php';

// Load the l10n class from moz-europe
require dirname(__FILE__).'/l10n_moz.class.php';

date_default_timezone_set('America/Los_Angeles');

$lang = "en-US";
$l10n = new l10n_moz();
$l10n->load("{$config['file_root']}/{$lang}/l10n/main.lang");
$firefoxDetails = new firefoxDetails();
