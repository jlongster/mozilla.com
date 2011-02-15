<?php

$body_class     = '';
$textdir        = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';
$oop            = '';
$oop_class      = '';
$personasnumber = 180000;
$logo           = '<h2><img src="/img/firefox/3.6/firstrun/title.png" alt="Firefox 3.6" id="title-logo" /></h2>';
$logo2          = '<img src="/img/firefox/3.6/firstrun/logo.png" alt="Firefox Logo" id="title-logo" />';
$aboutlink      = 'href="/'.$lang.'/about/"';
$footerfile     = $config['file_root'].'/includes/l10n/3.6/footer-inproductpages.inc.php';

if( $body_id == 'whatsnew' && $oldVersion == true) {
    $extraval1 = 'block';
    $extraval2 = '';
} else {
    $extraval1 = 'none';
    $extraval2 = 'padding-top:1em;';
}






if (!in_array($lang, array('as', 'bn-BD', 'bn-IN', 'en-GB', 'en-US', 'gu-IN', 'ga-IE', 'he', 'hi-IN', 'ja', 'kn', 'ml', 'mr', 'or', 'pa-IN', 'si', 'ta', 'ta-LK', 'te', 'th', 'zh-CN', 'zh-TW'))) {
   $personasnumber = number_format($personasnumber, 0, ',', '.');
} else {
    $personasnumber = number_format($personasnumber, 0, '.', ',');
}

require_once $config['file_root'] . '/includes/min/inline.php';
$inline_css_firstrun = min_inline_css('css_firstrun');


$extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/firefox/3.6/firstrun-page.css" media="screen" />
    <style>
    /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBlack';
        src: url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.eot');
        src: local('☺'), url('{$config['static_prefix']}/img/fonts/MetaWebPro-Black.woff') format('woff');
        font-weight: bold;
    }
    </style>

    <style>
      /* l10n mods */

    #wrapper {
        padding: 20px  !important;
    }

    #main-feature p {
        display:{$extraval1} !important;
    }

    h2 {
        font-size: 20px;
        color: #303030 ;
    }

    #intro  {
        position:relative !important;
        padding: 70px 50px 0 50px !important;
        min-height:334px !important;
    }

    #sidebar, #personalize, div.side-content {
        width: 273px !important;
    }

    #intro h2 {
        color: #303030 !important;
        font-family: georgia,serif !important;
        font-size: 28px !important;
        line-height: 1 !important;
        margin: 0 315px 0 0 !important;
    }

    iframe {
        border: 0 none !important;
        display: block !important;
        margin: 0 auto !important;
        position: absolute !important;
        right: 0 !important;
        top: 70px !important;
    }

    #sidebar {
        background-image:none !important;
        min-height:inherit !important;
        padding: 20px 45px !important;
    }

    #sidebar ul li a, #sidebar ul li a:link, #sidebar ul li a:visited {
        background-image: url("/img/mobile/m/nav-arrow.png") !important;
        background-position: 10px 10px !important;
        background-repeat: no-repeat !important;
        display: block !important;
        font-style: normal !important;
        line-height: inherit !important;
        font-size: inherit !important;
        padding: 15px 0 15px 50px !important;
        min-height:inherit !important;
    }

    #personalize,
    div.side-content {
        background-image: url("/img/firefox/3.6/firstrun/yeti-top.png");
        background-position: 100% 100%;
        background-repeat: no-repeat;
        float: left !important;
        margin-bottom: -20px !important;
        min-height: 200px;
        padding: 20px 45px !important;
        position:relative !important;
    }

    #sub-links {
        display:none !important;
    }

    #personas-image-link {
        display:none !important;
    }

    #intro p {

        font-style: italic !important;
        margin: 10px 275px 10px 0 !important;
    }


    #intro ul.link,
    #personalize ul.link,
    div.side-content ul.link
    {
        padding: 0 !important;
        width: 80% !important;
        position:absolute !important;
        bottom:50px !important;
    }

    #intro ul.link {
        bottom: 30px !important;
    }

    #intro ul.link li,
    #personalize ul.link li,
    div.side-content ul.link li
     {
        -moz-border-radius: 12px 12px 12px 12px !important;
        -moz-box-shadow: 0 2px rgba(0, 0, 0, 0.05), 0 -2px rgba(0, 0, 0, 0.05) inset !important;
        background: -moz-linear-gradient(center top , #FFFFFF 50%, #FCFCFC 0%) repeat scroll 0 0 #FFFFFF !important;
        border: 1px solid rgba(0, 0, 0, 0.15) !important;
        line-height: 24px !important;
        list-style-type: none !important;
        margin: 10px 0 0 !important;
        padding: 0 !important;
    }

    #intro ul.link li a,
    #personalize ul.link li a,
    div.side-content ul.link li a
      {
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAAQCAMAAADUOCSZAAAAM1BMVEU4AADB2fjv9f2SvPSpy/bg7Pyxz/eawfS51PiixvXY5/vJ3vn3+v7Q4vro8f2Kt/ODs/LKfzhhAAAAAXRSTlMAQObYZgAAAHZJREFUGNNt0EESgCAIBVBMzSyVf//TBrJpIDbO8AYEaNyksQb5ODH1yXl5OXjTAw40san8UAFOosHg6kRyShVW/A3NCV0/pLlFowEcf1KRrjlMh7TdjScbaf8ZgPoGcQ/JJupoDpYtmND8TZP1yC0e+7BDBHgBPWIGKLbjNQIAAAAASUVORK5CYII=") !important;
        background-position: 100% 50% !important;
        background-repeat: no-repeat !important;
        display: block !important;
        font-size: 16px !important;
        font-style: italic !important;
        min-height: 0 !important;
        padding: 5px 35px 7px 10px !important;
        text-decoration: none !important;
        text-shadow: 0 1px #E2F2FA !important;
        line-height: 24px !important;
        list-style-type: none !important;
    }

    #footer {
        width:270px !important;
        float:right !important;
         -moz-box-shadow: 1px 1px 1px lightgray !important;
    }


    #personalize ul li#sidebar-addons a,
    div.side-content ul li a
     {
        background-position: -400px 0 !important;
    }

    #personalize ul li a,
    div.side-content ul li a
     {
        background-image: url("/img/firefox/3.6/firstrun/sidebar-icons.png") !important;
        background-position: 0 0 !important;
        background-repeat: no-repeat !important;
    }

    #whatsnew #sidebar ul.link li {
        -moz-border-radius: inherit !important;
        -moz-box-shadow: inherit  !important;
        background: inherit !important;
        border: inherit!important;
        line-height: inherit !important;
        margin: inherit !important;
        padding: inherit !important;
    }

    #main-content {
        -moz-border-radius: 10px 10px 10px 10px !important;
        background-color: #E5F1FE !important;
        background-image: url("/img/firefox/3.6/firstrun/background-content.png") !important;
        background-position: 100% 100% !important;
        background-repeat: repeat-x !important;
        float: left !important;
        margin-top: -15px !important;
        width: 100% !important;
    }

    .hideme {
        display:none;
    }

    #whatsnew #footer ul.social {
        margin:15px 40px 15px 0 !important;
        padding-left:40px;
    }

    #footer ul.social li {
        -moz-border-radius: 0 !important;
        -moz-box-shadow: none !important;
        background: transparent !important;
        border:none !important;
        margin: 0 10px 0 0 !important;
    }
    #whatsnew ul#personas-link {
        margin: 15px 0 !important;
    }

    #whatsnew #personalize ul,
    #whatsnew div.side-content ul {
        margin: 15px 0 !important;
    }

    #whatsnew #main-feature h2 {
        margin: 0 !important;
        padding-left:140px;
        {$extraval2}
    }

    #whatsnew #main-feature.latest-version h2 {
        padding-left:0;
    }

    #whatsnew #main-feature img {
        height: auto !important;
        width: auto !important;
    }

    div.side-content {
        position:relative;
    }
    </style>

EXTRA_HEADERS;

if ($textdir == 'rtl') {
    $extra_headers .= <<<EXTRA_HEADERS
    <style>
    /* RTL support */

    </style>
EXTRA_HEADERS;
}

// special check for malayalam, we have a special promo for Mac for them (see bug 580365)

if ($lang == 'ml') {

    $oop .= <<<OOP
  <div class="sub-feature side-content" id="mlfont" style="display:none;"><div>
    <h2>മാകിനുള്ള രചന അക്ഷരസഞ്ചയം</h2>
    <p>നിങ്ങളുടെ ബ്രൌസറില്‍ മലയാളം ശരിയായി കാണുവാന്‍ രചന മാക് ഇന്‍സ്റ്റോള്‍ ചെയ്യുക.</p>
    <ul class="link">
      <li>
          <a href="http://sites.google.com/site/macmalayalam/">ഡൌണ്‍ലോഡ് ചെയ്യൂ</a>
      </li>
    </ul>
  </div></div>
  <script>
    // <![CDATA[

    if (gPlatform == 3 || gPlatform == 4) {
        if (document.getElementById('oop')) {
            document.getElementById('oop').style.display='none';
        }
        if (document.getElementById('personalize')) {
            document.getElementById('personalize').style.display='none';
        }

        document.getElementById('mlfont').style.display='';
    }

    // ]]>
  </script>
OOP;


}



?>
