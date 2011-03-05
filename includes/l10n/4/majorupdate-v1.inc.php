<?php

/* add correct links */

    $str3 = '<a href="http://www.mozilla.com/'.$lang.'/firefox/" class="upgrade" target="_blank">'.$str3.'</a>';

// RTL support
if ($textdir == 'rtl') {
    $extra_headers  .= <<<EXTRA_HEADERS
    {$extra_headers}
    <style type="text/css">

    </style>

EXTRA_HEADERS;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$lang?>" lang="<?=$lang?>" dir="<?=$textdir?>">
<head>
    <title><?=$str1?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <style media="all">@import "/style/tignish/content.css";</style>
    <style media="all">@import "/style/firefox/4.0/details.css";</style>
</head>

<body>

<div id="wrapper">

<div id="details-header">
    <h1><?=$str2?></h1>
    <p><?=$str3?></p>
</div>

<div id="details-content">
    <ul>
        <li><?=$str4?></li>
        <li><?=$str5?></li>
        <li><?=$str6?></li>
    </ul>
</div>

</div>

</body>
</html>
