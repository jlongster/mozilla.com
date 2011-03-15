<?php

$logolink  = '/img/firefox/3.6/firstrun/logo.png';
$logo      = '<h2><img src="'.$logolink.'" alt="Firefox Logo" id="title-logo" /><img src="/img/l10n/fx4-wordmark2.png" alt="Firefox Logo" id="title-wordmark" /></h2>';
$aboutlink = 'href="/'.$lang.'/about/"';
$slogan    = 'foobar';

// old 3.6 variables, avoid throwing an error
$extraval1 = $extraval2 = $oop = $oop_class = '';

$css = file_get_contents($config['file_root'].'/style/l10n/fx4-fistrun-fallback.css');

$extra_headers = <<<EXTRA_HEADERS
    <style>
        {$css}
    </style>
EXTRA_HEADERS;

if ($textdir == 'rtl') {
    $extra_headers .= <<<EXTRA_HEADERS
    <style>
    /* RTL support */

    #main-content {
        background-image: -moz-linear-gradient(left center , #F7F7FF 380px, #FFFFFF 380px)
    }

    #intro, #sidebar {
        float: right;
    }

    #sidebar h2:first-child {
        padding: 0 20px;
    }

    #sidebar ul li a:before,
    #personalize ul li a:before {
        content: url("/img/mobile/m/nav-arrow.png");
        -moz-transform: translate(27px) rotate(180deg);
        -moz-transform-origin: center center;
        float:right;
        height:25px;

    }

    #sidebar ul.link li a,
    #personalize ul.link li a {
        background-image:none;
        padding: 10px 40px 0px 35px;
        display:block;
        height:30px;
    }

    #sidebar ul.link,
    #personalize ul.link {
        float:right;
        padding-right:0;
    }

    #personalize {
        padding-top: 50px;
        float: right;
    }

    </style>
EXTRA_HEADERS;
}

// slogan taken from Fx Source code
include $config['file_root'].'/includes/l10n/4/slogans.inc.php';


if(array_key_exists($lang, $slogan)) {

    $finalslogan = strip_tags($slogan[$lang]);

    $needle = array('!', '！', '.');
    foreach ($needle as $var) {
        $endsentence = ($var == '.') ? '' : $var; // period doesn't look good in a title
        if(strpos($finalslogan, $var)) {
            $finalslogan = explode($var, $finalslogan);
            foreach ($finalslogan as $key => $parts) {
                $finalslogan[$key] = ltrim($parts);
            }

            $finalslogan[0] = '<em>'.$finalslogan[0].$endsentence.'</em><br/>';
            $finalslogan = implode('', $finalslogan);
            if($var == '.') $finalslogan .= '.';
            break;
        }
    }
} else {
    $finalslogan = $page_title;
}

$promobox = <<<PROMO
    <div id="action">
        <h2>{$finalslogan}</h2>
    </div>
    <div id="screenshot"><div id="shade"></div><a href="/{$lang}/firefox/features/"><img src="/img/l10n/diagram.png" /></a></div>
PROMO;

unset($css);

?>
