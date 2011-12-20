<?php

$version      = '';
$full_version = '';

preg_match('/(firefox|mobile)\/([0-9]+)([^\/]*)\/.*/i',
           $_SERVER['PHP_SELF'],
           $matches);

if( !empty($matches[2]) ) {
    $version = $matches[2];
}

if( !empty($matches[2]) ) {
    $full_version = $matches[2] . $matches[3];
}

?>
