<!DOCTYPE HTML>
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
    $tmp      = array_diff($array1, $array2);
    $value    = '';
    $last_key = end((array_keys($tmp)));

    foreach ($tmp as $key => $val) {

        if ($key != $last_key) {
            $value .=  $val . ', ';
        } else {
            $value .=  $val;
        }
    }

    if ($value == '') {
        $value = 'mozilla-central and product-details have the same locales for the changeset requested';
    }

    return $value;
}

function handleErrors($error) {

    switch($error) {

        case '1':
            echo '<p>Not enough GET variables, please indicate:</p>
                <dl>
                    <dt>Changeset of the release:</dt>
                        <dd>hg=c93fe6829c74</dd>
                    <dt>Repository:</dt>
                        <dd>type=mozilla-beta</dd>
                </dl>';
                die();
            break;

        case '2':
            die('Error, unknown repo');
            break;

        case '3':
            die('The changeset/repo combination is not correct');
            break;

        default:
            return true;
            break;
        }

    return false;
}


// Load the product details classes
require dirname(__FILE__).'/../../product-details/firefoxDetails.class.php';

// variables
$fx          = new firefoxDetails();
$pd          = array();
$repoMapping = array (
    'LATEST_FIREFOX_VERSION'        => 'mozilla-release',
    'LATEST_FIREFOX_DEVEL_VERSION'  => 'mozilla-beta',
    'LATEST_FIREFOX_OLDER_VERSION'  => 'mozilla-1.9.2',
    'FIREFOX_AURORA'                => 'mozilla-aurora',
);



// clean and check validity of request
if ( isset($_GET['hg']) && isset($_GET['type']) ) {
    $changeset = secureText($_GET['hg']);
    $type      = secureText($_GET['type']);
    $hg        = 'http://hg.mozilla.org/releases/' . $type . '/raw-file/' . $changeset . '/browser/locales/shipped-locales';
} else {
    handleErrors(1);
}

// define repos
$repo = array_search($type, $repoMapping);

if ($repo == false) {
    handleErrors(2);
};

// extract hg shipped-locales file
$file = @file($hg, FILE_IGNORE_NEW_LINES);
if ($file ==  false) {
    handleErrors(3);
}

if ( in_array('ja linux win32', $file) && in_array('ja-JP-mac osx', $file) ) {
    unset($file[array_search('ja linux win32', $file)]);
    unset($file[array_search('ja-JP-mac osx', $file)]);
    $file[] = 'ja';
    asort($file);
    $file = array_values($file);
}

foreach ($fx->primary_builds as $key => $val) {

    if ( isset($val[constant($repo)]) ) {
        $pd[] = $key;
    }
}

foreach ($fx->beta_builds as $key => $val) {

    if( isset($val[constant($repo)]) ) {
        $pd[] = $key;
    }
}

?>
<html dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Check product-details status vs hg changeset</title>


    <style type="text/css">

    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('http://mozcom-cdn.mozilla.net/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('http://mozcom-cdn.mozilla.net/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }

    body {
        background-color: white;
        color: black;
        font-family: Georgia, serif;
        font-size:16px;
    }

    h4 {
        font-family: MetaBlack;
        margin-bottom:0;
    }

    h4 + p, h4 + ul  {
        margin-top: 0 !important;
    }

    </style>



</head>

<body>

<h4>Product-details values currently set on this website</h4>

<ul>
    <li>LATEST_FIREFOX_VERSION: <?php echo LATEST_FIREFOX_VERSION; ?></li>
    <li>LATEST_FIREFOX_DEVEL_VERSION: <?php echo LATEST_FIREFOX_DEVEL_VERSION; ?></li>
    <li>LATEST_FIREFOX_OLDER_VERSION: <?php echo LATEST_FIREFOX_OLDER_VERSION; ?></li>
    <li>FIREFOX_AURORA: <?php echo FIREFOX_AURORA; ?></li>
</ul>



<h4>Requested repository: <?php echo $type; ?></h4>
<p><em>that is Firefox <?php echo constant($repo); ?> in product-details<br/>
(changeset: <?php echo $changeset; ?> - <a href="<?php echo $hg; ?>">HG source</a>)</em></p>

<h4>Locales we have built in the above changeset but are not proposed on the website:</h4>

<p><?php echo getLocales($file, $pd); ?></p>

<h4>Locales we propose on the website but don't have builds for:</h4>

<p><?php echo getLocales($pd, $file); ?></p>

</body>
</html>
