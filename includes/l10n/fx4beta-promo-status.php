<?php

/*
 * outputs the locales that have finished bug 586086
 *
 * quick easy and temporary status script for laura mesa so she doesn't have to dive into
 * bugzilla, dashboards, ping localizers or l10n drivers...
 *
 */


// Load our config
require dirname(__FILE__).'/../config.inc.php';

// Load our language config
require $config['file_root'].'/includes/langconfig.inc.php';

// Load the l10n class from moz-europe
require $config['file_root'].'/includes/l10n_moz.class.php';

// common functions
require $config['file_root'].'/includes/functions.inc.php';


foreach ($full_languages as $locale) {

    $file = $config['file_root'].'/'.$locale.'/includes/l10n/main.lang';

    $l10n = new l10n_moz();

    if (file_exists($file)) {

        $l10n->load($file);

        // special promo for firefox 4 beta

        $promo = array('');
        $promo[0] = "Take a Look at Tomorrow's Web";
        $promo[1] = 'Journey to the Future with Firefox&nbsp;4';
        $promo[2] = 'Join the Beta Program';
        $promo[3] = 'Experience Firefox&nbsp;4';
        $promo[4] = 'The future of the Web is waiting for you!';
        $displaypromo = true;

        $boo = false;
        foreach ($promo as $key => $val) {
            if (i__($val) == false) {
                $boo = true;
            }
        }

        if (!$boo) {
            echo $locale.': ok <br>';

        }
    }
    unset($l10n);
}


?>
