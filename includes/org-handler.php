<?php

// This script processes mozilla.org URLs which have been sent here
// from .htaccess. It's the same as prefetch.php, but loads in the
// mozilla.org codebase. It does everything that mozilla.org's
// prefetch.php does, but throws mozilla.com's 404.

require_once("../org/includes/config.inc.php");

// Append the index page if necessary
if (is_dir("{$config['file_root']}/{$_SERVER['REDIRECT_URL']}")) {
    // Append a trailing slash if not present
    if(strrchr($_SERVER['REDIRECT_URL'], '/') != '/') {
        header("Location: {$config['url_scheme']}://{$config['server_name']}{$_SERVER['REDIRECT_URL']}/");
        exit;
    }
    
    $_SERVER['REDIRECT_URL'] = "$path{$config['directory_index']}";
}

$www_archive_base = '/data/www/www-archive.mozilla.org';
$path = $_SERVER['REDIRECT_URL'];
$www_archive_path = realpath($www_archive_base . $path);

// Redirect if it's in the archive
if(strpos($www_archive_path, $www_archive_base) == 0 && file_exists($www_archive_path)) {
    header("Status: 301 Moved Permanently");
    header("Location: http://www-archive.mozilla.org$path");
    exit;
}

if(file_exists("{$config['file_root']}/$path")) {
    require("{$config['file_root']}/$path");
    exit;
}
else {
    // Show a 404 page (mozilla.com prefetch will take care of it)
    require('prefetch.php');
}

?>
