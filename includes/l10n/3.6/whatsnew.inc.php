<?php

/**
 * Extra HTML head content for the "What's New" page for Firefox 3.6.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

$transitional   = true;
$body_id        = 'whatsnew';
$_version       = getVersionBySelf();
$_valid_version = isValidVersionByReleaseNotes($_version, $config['file_root'], $lang);
$_pre_oop       = array('3.6', '3.6.2','3.6.3');
$show_oop_promo = false;
$detect_flash   = true;
$detect_flash   = true;


// check if there is a version
if ($_version !== null && $_valid_version) {
    // check if we're running the latest version
    if (strcmp($_version, LATEST_FIREFOX_VERSION) == 0) {
        $latestVersion  = true;
        $oldVersion     = false;
        $unknownVersion = false;
    } else {
        $latestVersion  = false;
        $oldVersion     = true;
        $unknownVersion = false;
    }
} else {
    $latestVersion  = false;
    $oldVersion     = false;
    $unknownVersion = true;
}

require_once $config['file_root'].'/includes/l10n/3.6/firstrunwhatsnew-common.inc.php';

$mozilla_europe = array('bg', 'ca', 'cs', 'da', 'de', 'el', 'en-GB', 'es-ES', 'eu', 'fi', 'fr', 'hu', 'it', 'lt', 'nb-NO', 'nl', 'nn-NO', 'pl', 'pt-PT', 'ro', 'ru', 'sk', 'sq', 'sv-SE', 'sr', 'tr', 'uk');
$europe_mapping = array('en-GB' => 'en', 'es-ES' => 'es', 'nb-NO' => 'no', 'nn-NO' => 'no', 'pt-PT' => 'pt', 'sv-SE' => 'sv');


if (!in_array($_version, $_pre_oop)) {

    $oopstr1 = 'New: Crash Protection';
    $oopstr2 = 'Continue browsing even when your video or game crashes.';
    $oopstr3 = 'Learn More';

    if (c__($oopstr1) AND c__($oopstr2) AND c__($oopstr3)) {

        if (in_array($lang, $mozilla_europe)) {
            if (array_key_exists($lang, $europe_mapping)) {
                $val = $europe_mapping[$lang];
            } else {
                $val = $lang;
            }
            $oop_url = "http://www.mozilla-europe.org/{$val}/firefox/features/#performance";
        } else {
            $oop_url = "/{$lang}/firefox/features/#performance";
        }

        $oopstr1        = ___('New: Crash Protection');
        $oopstr2        = ___('Continue browsing even when your video or game crashes.');
        $oopstr3        = ___('Learn More');
        $show_oop_promo = true;
        $oop_class      = ' hideme';
        $oop           .= <<<OOP

  <div class="sub-feature side-content" id="oop"><div>
    <h2>{$oopstr1}</h2>
    <p>{$oopstr2}</p>
    <ul class="link">
      <li>
          <a href="{$oop_url}">{$oopstr3}</a>
      </li>
    </ul>
  </div></div>

OOP;
    }

}





$flash1 = 'You should <a href="http://get.adobe.com/flashplayer/">update Adobe Flash Player</a> right now.';
$flash2 = 'Firefox is up to date, but your current version of Flash Player can cause security and stability issues.  Please <a href="http://get.adobe.com/flashplayer/">install the free update</a> as soon as possible.';

if ( $lang != 'en-US' AND ___($flash1) != $flash1 AND ___($flash2) != $flash2 )
{

$str1 = ___($flash1);
$str1 = str_replace('<a href="http://get.adobe.com/flashplayer/">', '<a href="http://get.adobe.com/flashplayer/" onclick="dcsMultiTrack(\'DCS.dcssip\', \'get.adobe.com\', \'DCS.dcsuri\', \'/flashplayer/\', \'WT.ti\', \'Adobe&20-%20Adobe%20Flash%20Player\');">', $str1);
$str1 = addslashes(___($str1));

$str2 = ___($flash2);
$str2 = str_replace('<a href="http://get.adobe.com/flashplayer/">', '<a href="http://get.adobe.com/flashplayer/" onclick="dcsMultiTrack(\'DCS.dcssip\', \'get.adobe.com\', \'DCS.dcsuri\', \'/flashplayer/\', \'WT.ti\', \'Adobe&20-%20Adobe%20Flash%20Player\');">', $str2);
$str2 = addslashes(___($str2));


$extra_footers = <<<EXTRA_FOOTERS
    <script>
    // <![CDATA[
        FlashAlertTitle = '{$str1}';
        FlashAlertText  = '{$str2}';
    // ]]>
    </script>

<script type="text/javascript" >
    // <![CDATA[

    if(gPlatform == 3 || gPlatform == 4) {
        document.getElementById('oop').style.display='none';
        document.getElementById('personalize').className='sub-feature';
    }

    // ]]>
</script>

EXTRA_FOOTERS;
}



// special check for malayalam, we have a special promo for Mac for them (see bug 580365)

if ($lang == 'ml') {

    $oop .= <<<OOP
  <div class="sub-feature" id="mlfont" style="display:none;"><div>
    <h3>മാകിനുള്ള രചന അക്ഷരസഞ്ചയം</h3>
    <p>നിങ്ങളുടെ ബ്രൌസറില്‍ മലയാളം ശരിയായി കാണുവാന്‍ രചന മാക് ഇന്‍സ്റ്റോള്‍ ചെയ്യുക.</p>
    <ul class="link">
      <li>
          <a href="http://sites.google.com/site/macmalayalam/">ഡൌണ്‍ലോഡ് ചെയ്യൂ</a>
      </li>
    </ul>
  </div></div>
  <script type="text/javascript">
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
    <style type="text/css">
    div#mlfont.sub-feature {
        font-size:14px;
    }

    div#mlfont.sub-feature p{
        margin-bottom:5px;
    }

  </style>
OOP;


}

// special promo for firefox 4 beta

$promo = array('');
$promo[0] = "Take a Look at Tomorrow's Web";
$promo[1] = 'Journey to the Future with Firefox';
$promo[2] = 'Join the Beta Program';
$promo[3] = 'Experience Firefox';
$promo[4] = 'The future of the Web is waiting for you!';
$displaypromo = ($_version == '3.6.13') ? true : false;

foreach ($promo as $key => $val) {
    if (i__($val) == false && $lang != 'en-GB') {
        $displaypromo = false;
        break;
    } else {
        $promo[$key] = ___($val);
    }
}

if($displaypromo) {

$oop .= <<<OOP




<style>

#main-content #beta4promo1, #main-content #beta4promo2 {
    background: url("/img/firefox/beta/4/firstrun/l10npromo.jpg") no-repeat scroll left center transparent;
    color: white;
    text-shadow: 2px 1px 2px black;
    min-height:146px;
    background-position: auto !important;
    background-repeat: no-repeat !important;
    -moz-border-radius: 10px;
    position: relative !important;
    width: 200px !important;
    margin-left: 35px;
    margin-right: 35px;
}


#main-content #beta4promo1 h3, #main-content  #beta4promo2 h3 {
    font-family: georgia;
    font-size: 14px;
    font-weight: bold;
    margin: 0 0 5px;
    text-align: center;
    text-transform: uppercase;
    color: white;
}

#main-content #beta4promo1 p, #main-content  #beta4promo2 p {
    color:white;
     margin: 25px 0;
}

#main-content #beta4promo1 h3, #main-content #beta4promo2 h3 {
    -moz-border-radius: 5px 5px 5px 5px;
    background-color: rgba(255, 255, 255, 0.8);
    color: darkorange;
    font-family: arial;
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 1px;
    line-height: 24px;
    margin: 0 0 5px;
    padding: 5px 0;
    text-align: center;
    text-shadow: 1px 1px 1px black;
    text-transform: uppercase;
}

#main-content #beta4promo1 a, #main-content #beta4promo2 a {
    color: white;
    height: 100px;
    left: 0;
    top: 0;
    line-height: 146px;
    padding-top: 74px;
    position: absolute;
    text-align: center;
    width:100%;
    letter-spacing:-0.5px
}

#footer {
    background-image: url("/img/firefox/3.6/firstrun/background-footer.png");
    background-repeat: repeat;
}

</style>
<div class="sub-feature side-content" id="beta4promo1" style="display:none;"><div>
    <h3>{$promo[0]}</h3>
    <a href="/{$lang}/firefox/beta/">{$promo[2]}</a>
</div></div>

<div class="sub-feature side-content" id="beta4promo2" style="display:none;"><div>
    <h3>{$promo[1]}</h3>
    <a href="/{$lang}/firefox/beta/">{$promo[2]}</a>
</div></div>


  <script type="text/javascript">
    // <![CDATA[

    var promo1 = document.getElementById('beta4promo1');
    var promo2 = document.getElementById('beta4promo2');
    var mlfont = document.getElementById('mlfont');
    var addons = document.getElementById('personalize');
    var oop    = document.getElementById('oop');

    var globalrotation = 0.6;
    var promo1rotation = 0.5;
    var promo2rotation = 1 - promo1rotation;
    var rand = Math.random();

    if (rand < globalrotation) {
        if(mlfont) { mlfont.style.display = 'none';}
        if(addons) { addons.style.display = 'none';}
        if(oop)    { oop.style.display    = 'none';}

        if (rand < promo2rotation) {
            promo2.style.display='';
        } else {
            promo1.style.display='';
        }
    }

    // ]]>
  </script>

OOP;
}
// end of special promo for firefox 4 beta


// Include the global header.  All locales will include this.
require "{$config['file_root']}/includes/headers/3.6/portal-pages.inc.php";

// Built dynamically in the global header now, to provide consistency across
// pages.
echo $dynamic_header;

unset($dynamic_header);

unset($dynamic_top_menu);

?>
