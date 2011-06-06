<?php

function secureText($var, $tablo = true) {
    if (!is_array($var)) {
        $var   = array($var);
        $tablo = false;
    }

    foreach ($var as $item => $value) {
        // CRLF XSS
        $item  = str_replace('%0D', '', $item);
        $item  = str_replace('%0A', '', $item);
        $value = str_replace('%0D', '', $value);
        $value = str_replace('%0A', '', $value);
        $item  = strip_tags($item);
        $value = strip_tags($value);

        // Repopulate value
        $var2[$item] = $value;
    }

    return ($tablo == true) ? $var2 : $var2[0];
}

function getLocales($array1, $array2) {
    $tmp   = array_diff($array1, $array2);
    $value = '';

    foreach ($tmp as $val) {
        $value .=  $val . ', ';
    }

    return $value;
}

// Load the product details classes
require dirname(__FILE__).'/../../product-details/firefoxDetails.class.php';
$fx = new firefoxDetails();
$pd = array();

if ( isset($_GET['fx']) && isset($_GET['hg']) && isset($_GET['type']) ) {
    $release   = secureText($_GET['fx']);
    $changeset = secureText($_GET['hg']);
    $type      = secureText($_GET['type']);
    $hg  = 'http://hg.mozilla.org/releases/' . $type . '/raw-file/' . $changeset . '/browser/locales/shipped-locales';
} else {
    echo "
    Not enough GET variables, please indicate:<br/>
    <dl>
        <dt>Version:</dt>
            <dd>fx=5.0b3</dd>
        <dt>Changeset of the release:</dt>
            <dd>hg=c93fe6829c74</dd>
        <dt>Repository:</dt>
            <dd>type=mozilla-beta</dd>
    </dl>";

    exit;
}

$file = file($hg, FILE_IGNORE_NEW_LINES);

if (in_array('ja linux win32', $file) && in_array('ja-JP-mac osx', $file) ) {
    unset($file[array_search('ja linux win32', $file)]);
    unset($file[array_search('ja-JP-mac osx', $file)]);
    $file[] = 'ja';
    asort($file);
    $file = array_values($file);
}

foreach($fx->primary_builds as $key => $val) {

    if(isset($val[$release])) {
        $pd[] = $key;
    }
}

foreach($fx->beta_builds as $key => $val) {

    if(isset($val[$release])) {
        $pd[] = $key;
    }
}

echo 'RELEASE:' . $release . '<br/>';
echo '<a href="' . $hg . '">HG source</a><br/>';

echo '<p>Locales we have built but are not proposed on the website:</p>';

echo getLocales($file, $pd);

echo '<p>Locales we propose on the website but don\'t have builds for:</p>';

echo getLocales($pd, $file);
