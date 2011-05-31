<?php

// define an array of locales to remap from gettext to mozilla codes

$locale_mapping = array(
    'fy'    => 'fy-NL',
    'ga'    => 'ga-IE',
    'es'    => 'es-ES',
    'pt_BR' => 'pt-BR',
    'zh_TW' => 'zh-TW',
);

// define a path for remapped locales

foreach($locale_mapping as $shortl => $longl){
    if($longl == $lang){
        $mapped_lang = $shortl;
    }
}
