<?php
@include $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
@include $_SERVER['DOCUMENT_ROOT'].'/includes/redirect.php';
@include $_SERVER['DOCUMENT_ROOT'].'/includes/functions.inc.php';

// $_SERVER['REMOTE_ADDR'] = '62.1.204.72'; // Greece
// $_SERVER['REMOTE_ADDR'] = '178.90.194.93'; // kazakhstan
// $_SERVER['REMOTE_ADDR'] = '62.89.31.255'; // Armenia

// this is the locale code we detect based on http accept-lang headers
$locale   = $lang;
$country  = getLocaleCodeByIP('en');
$geo      = ($country != '') ? '?geo=' . $country : '';
$redirect = $locale . '/' . $geo;
$ip       = getIP();

if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = str_replace('%0D', '', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = str_replace('%0A', '', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']);
} else {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'empty';
}


header('Date: '.gmdate('D, d M Y H:i:s \G\M\T', time()));
header('Expires: Fri, 01 Jan 1990 00:00:00 GMT');
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private');
header('Vary: *');

echo "Your IP address is: $ip <br/>";;
echo "Your locale based on your IP is: $country <br/>";
echo "Your accept-lang headers are: ${_SERVER['HTTP_ACCEPT_LANGUAGE']} <br/>";

echo "The parameter for the home page based on your accept-lang/IP would be: $redirect <br/>";


