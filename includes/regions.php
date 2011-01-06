<?php

require_once dirname(__FILE__) .'/functions.inc.php';

function regionNames($lang = 'en-US') {
    require 'config.inc.php';
    $countries = propertiesToArray($config['file_root']. "/". $lang. "/includes/l10n/regionNames.properties");
    asort($countries, SORT_LOCALE_STRING);
    return $countries;
}

function regionsAsOptions($lang, $selected='') {
    $out = '';
    foreach (regionNames() as $code => $name) {
        $is_selected = ($code == $selected) ? " selected='selected'" : "";
        $out .= "<option value='{$code}'{$is_selected}>{$name}</option>\n";
    }
    return $out;
}
