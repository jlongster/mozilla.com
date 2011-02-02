<?php

require_once "{$config['file_root']}/includes/product-details/regionDetails.class.php";

function regionsAsOptions($lang, $selected='') {
    $regionDetails = new regionDetails();
    $names = $regionDetails->getRegionNames($lang);
    
    $out = '';
    foreach($names as $code => $name) {
        $is_selected = ($code == $selected) ? " selected='selected'" : "";
        $out .= "<option value='{$code}'{$is_selected}>{$name}</option>\n";
    }
    return $out;
}
