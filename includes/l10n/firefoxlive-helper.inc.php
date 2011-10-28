<?php

// temporary include

l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/firefoxlive.lang');

$fb_locale_codes= array(
    'fr' => 'fr_FR',
    'it' => 'it_IT',
);

$fb_locale = array_key_exists($lang, $fb_locale_codes) ? $fb_locale_codes[$lang] : 'en_US';
