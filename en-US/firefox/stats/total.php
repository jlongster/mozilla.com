<?php

header('Expires: ' . gmdate("D, d M Y H:i:s", floor((time() + 60) / 60) * 60) . ' GMT'); 

$url = 'http://downloadstats.mozilla.com/data/country_report.json';
$session = curl_init($url);

// Set curl options
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// Make the request
$response = curl_exec($session);

// Close the curl session
curl_close($session);
$a = json_decode($response);

$summary = null;

foreach ($a->countries AS $country) {
    if ($country->code == '**')
    {
        $summary = $country;
        break;
    }
}

$json = json_encode(array($summary->total));

if ($_REQUEST['callback'])
{
    header('Content-type: text/javascript');
    printf("%s(%s)",$_REQUEST['callback'],$json);
} else {
    header('Content-type: application/json');
    echo $json;
}

