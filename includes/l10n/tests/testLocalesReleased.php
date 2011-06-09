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

// variables
$fx = new firefoxDetails();
$pd = array();
$repoMapping = array (

    'LATEST_FIREFOX_VERSION'        => 'mozilla-2.0',
    'LATEST_FIREFOX_DEVEL_VERSION'  => 'mozilla-beta',
    'LATEST_FIREFOX_OLDER_VERSION'  => 'mozilla-1.9.2',
    'FIREFOX_AURORA'                => 'mozilla-aurora',


);



// clean and check validity of request
if ( isset($_GET['hg']) && isset($_GET['type']) ) {
    $changeset = secureText($_GET['hg']);
    $type      = secureText($_GET['type']);
    $hg = 'http://hg.mozilla.org/releases/' . $type . '/raw-file/' . $changeset . '/browser/locales/shipped-locales';

} else {
    echo "
    <p>Not enough GET variables, please indicate:</p>
    <dl>
        <dt>Changeset of the release:</dt>
            <dd>hg=c93fe6829c74</dd>
        <dt>Repository:</dt>
            <dd>type=mozilla-beta</dd>
    </dl>";

    exit;
}

// define repos
$repo = array_search($type, $repoMapping);
if ($repo == false) {
    die('Error, unknown repo');
};


// extract hg shipped-locales file
$file = @file($hg, FILE_IGNORE_NEW_LINES);
if ($file ==  false) {
    die('The changeset/repo combination is not correct');
}

if (in_array('ja linux win32', $file) && in_array('ja-JP-mac osx', $file) ) {
    unset($file[array_search('ja linux win32', $file)]);
    unset($file[array_search('ja-JP-mac osx', $file)]);
    $file[] = 'ja';
    asort($file);
    $file = array_values($file);
}

foreach($fx->primary_builds as $key => $val) {

    if(isset($val[constant($repo)])) {
        $pd[] = $key;
    }
}

foreach($fx->beta_builds as $key => $val) {

    if(isset($val[constant($repo)])) {
        $pd[] = $key;
    }
}




echo '<h4>Product-details values currently set on this website</h4>';
echo '<ul>';
echo '<li>LATEST_FIREFOX_VERSION: ' . LATEST_FIREFOX_VERSION;
echo '<li>LATEST_FIREFOX_DEVEL_VERSION: ' . LATEST_FIREFOX_DEVEL_VERSION;
echo '<li>LATEST_FIREFOX_OLDER_VERSION: ' . LATEST_FIREFOX_OLDER_VERSION;
echo '<li>FIREFOX_AURORA: ' . FIREFOX_AURORA;
echo '</ul>';



echo '<p>Requested repository:<strong> ' . $type . '</strong>, that is Firefox ' . constant($repo) . ' in product-details<br/> ';
echo '(changeset: ' . $changeset .' - <a href="' . $hg . '">HG source</a>)</p>';

echo '<p>Locales we have built in the above changeset but are not proposed on the website:</p>';

echo getLocales($file, $pd);

echo '<p>Locales we propose on the website but don\'t have builds for:</p>';

echo getLocales($pd, $file);
