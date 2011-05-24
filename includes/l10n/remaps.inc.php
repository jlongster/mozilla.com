<?php

// define a array of locales to remap

$locale_mapping = array(
    'fy'    => 'fy-NL',
    'ga'    => 'ga-IE',
    'es'    => 'es-ES',
);

// define a path for remapped locales

foreach($locale_mapping as $shortl => $longl){
    if($longl == $lang){
        $mapped_lang = $shortl;
    }
}


?>
