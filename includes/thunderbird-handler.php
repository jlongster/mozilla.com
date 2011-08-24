<?php

// Patch the path to force a trailing slash
if($_SERVER['REQUEST_URI'] == '/thunderbird') {
    $_SERVER['REQUEST_URI'] = '/thunderbird/';
    $_SERVER['REDIRECT_URI'] = '/thunderbird/';
}

require("../org/thunderbird/includes/prefetch.php");

?>