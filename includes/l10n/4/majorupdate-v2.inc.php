<?php

/* add correct links */
/*
$str3 = '<a href="http://www.mozilla.com/'.$lang.'/firefox/channel/" class="button" target="_blank">'.$str3.'</a>';
*/


// RTL support
if ($textdir == 'rtl') {
    $extra_headers  .= <<<EXTRA_HEADERS
    {$extra_headers}
    <style type="text/css">

    </style>

EXTRA_HEADERS;
}

?>

<!doctype html>
<html lang="<?=$lang?>" dir="<?=$textdir?>">
<head>
    <title><?php echo strip_tags($str1);?></title>
    <meta charset="utf-8">
    <style media="all">@import "/style/firefox/channel/aurora/details.css";</style>
</head>

<body billboard="1">


    <h1><?=$str1?></h1>

    <ul>
        <li><?=$str2?></li>
        <li><?=$str3?></li>
        <li><?=$str4?></li>
    </ul>

</body>
</html>
