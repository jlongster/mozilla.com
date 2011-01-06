<?php

header('Expires: ' . gmdate("D, d M Y H:i:s", floor((time() + 60) / 60) * 60) . ' GMT'); 
header('Content-type: application/json');

$url = 'http://downloadstats.mozilla.com/' . $_REQUEST['q'];
$session = curl_init($url);

// Set curl options
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// Make the request
$response = curl_exec($session);

// Close the curl session
curl_close($session);

echo $response;
