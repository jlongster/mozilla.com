<?php

/**
 * Extra HTML head content for the "First Run" page for Firefox 3.6.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id = 'firstrun';

require_once $config['file_root'] . '/includes/min/inline.php';
$inline_css_firstrun = min_inline_css('css_firstrun');

require_once $config['file_root'].'/includes/l10n/3.6/firstrunwhatsnew-common.inc.php';


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




// Include the global header.  All locales will include this.
require "{$config['file_root']}/includes/headers/3.6/portal-pages.inc.php";

// Built dynamically in the global header now, to provide consistency across
// pages.
echo $dynamic_header;

unset($dynamic_header);

unset($dynamic_top_menu);

?>
