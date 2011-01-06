<?php

define('MINIFY_MIN_DIR', $config['file_root']. '/includes/min');

// load config
require MINIFY_MIN_DIR . '/config.php';

// setup include path
set_include_path($min_libPath . PATH_SEPARATOR . get_include_path());

require 'Minify.php';

Minify::$uploaderHoursBehind = $min_uploaderHoursBehind;
Minify::setCache(
    isset($min_cachePath) ? $min_cachePath : ''
    ,$min_cacheFileLocking
);

if ($min_documentRoot) {
    $_SERVER['DOCUMENT_ROOT'] = $min_documentRoot;
} elseif (0 === stripos(PHP_OS, 'win')) {
    Minify::setDocRoot(); // IIS may need help
}

$min_serveOptions['minifierOptions']['text/css']['symlinks'] = $min_symlinks;

if ($min_allowDebugFlag && isset($_GET['debug'])) {
    $min_serveOptions['debug'] = true;
}

if ($min_errorLogger) {
    require_once 'Minify/Logger.php';
    if (true === $min_errorLogger) {
        require_once 'FirePHP.php';
        Minify_Logger::setLogger(FirePHP::getInstance(true));
    } else {
        Minify_Logger::setLogger($min_errorLogger);
    }
}

// check for URI versioning
if (preg_match('/&\\d/', $_SERVER['QUERY_STRING'])) {
    $min_serveOptions['maxAge'] = 31536000;
}
$min_serveOptions['minApp']['groups'] = (require MINIFY_MIN_DIR . '/groupsConfig.php');

$min_serveOptions['quiet'] = true;
$min_serveOptions['encodeOutput'] = false;

function min_inline_js($group)
{
    global $min_serveOptions;
    
    $_GET['g'] = $group;
    $min = Minify::serve('MinApp', $min_serveOptions);

    $output = '<script type="text/javascript">' . "\n";
    $output .= $min['content'];
    $output .= "\n" . '</script>';
    
    return $output;
}

function min_inline_css($group)
{
    global $min_serveOptions;
    
    $_GET['g'] = $group;
    $min = Minify::serve('MinApp', $min_serveOptions);
    $content = use_cdn_urls($min['content']);
    
    $output = '<style type="text/css">' . "\n";
    $output .= $content;
    $output .= "\n" . '</style>';

    return $output;
}

function use_cdn_urls($css)
{
    global $config;
    
    $search = array('url(/',
                    'url("/',
                    "url('/");
    $replace = array('url('.$config['static_prefix'].'/',
                     'url("'.$config['static_prefix'].'/',
                     "url('".$config['static_prefix'].'/');
    $output = str_replace($search, $replace, $css, $count);
    
    return $output;
}

function min_inline_image($path)
{
    global $config;
    
    $allowed_mimes = array('png', 'jpg');
    
    $file = $config['file_root'].$path;
    $filename_array = explode('.', basename($file));
    $mime = array_pop($filename_array);
    if (!in_array($mime, $allowed_mimes)) {
        throw new Exception('Wrong file extension for mimetype: ' . $path);
    }
    
    $contents = file_get_contents($file);
    $base64   = base64_encode($contents);

    return ('data:image/' . $mime . ';base64,' . $base64);
}
?>