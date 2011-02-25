<?php
/**
 * This file is separate from config.inc.php because we want these variables to be
 * easily updatable from SVN.
 */


/**
 * A mapping between the short name for the language and the full name of the language
 * (encoded to print in html).  Locales don't need to be in this list if they are
 * being remapped.
 */
$native_languages = array(
    'ak'        => 'Akan',
    'af'        => 'Afrikaans',
    'ar'        => '&#1593;&#1585;&#1576;&#1610;',
    'as'        => '&#2437;&#2488;&#2478;&#2496;&#2479;&#2492;&#2494;',
    'ast'       => 'Asturianu',
    'bg'        => '&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;',
    'bs'        => 'Bosanski',
    'be'        => 'Беларуская',
    'br'        => 'breton',
    'bn-IN'     => '&#2476;&#2494;&#2434;&#2482;&#2494;',
    'ca'        => 'Catal&#224;',
    'cs'        => '&#268;e&#353;tina',
    'cy'        => 'Cymraeg',
    'da'        => 'Dansk',
    'de'        => 'Deutsch',
    'el'        => '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;',
    'en-GB'     => 'English (British)',
    'en-US'     => 'English (US)',
    'en-ZA'     => 'English (South African)',
    'es-AR'     => 'Espa&#241;ol (Argentina)',
    'es-CL'     => 'Espa&#241;ol (Chile)',
    'es-ES'     => 'Espa&#241;ol (Espa&#241;a)',
    'es-MX'     => 'Espa&#241;ol (México)',
    'eo'        => 'Esperanto',
    'et'        => 'Eesti keel',
    'eu'        => 'Euskara',
    'fa'        => '&#1601;&#1575;&#1585;&#1587;&#1740;',
    'fi'        => 'Suomi',
    'fr'        => 'Fran&#231;ais',
    'fy-NL'     => 'Frysk',
    'ga-IE'     => 'Gaeilge',
    'gd'        => 'Gàidhlig',
    'gl'        => 'Galego',
    'gu-IN'     => '&#2711;&#2753;&#2716;&#2736;&#2750;&#2724;&#2752;',
    'he'        => '&#1506;&#1489;&#1512;&#1497;&#1514;',
    'hi-IN'     => '&#2361;&#2367;&#2344;&#2381;&#2342;&#2368; (&#2349;&#2366;&#2352;&#2340;)',
    'hr'        => 'Hrvatski',
    'hu'        => 'Magyar',
    'hy-AM'     => '&#1344;&#1377;&#1397;&#1381;&#1408;&#1381;&#1398;',
    'id'        => 'Bahasa Indonesia',
    'is'        => '&#205;slenska',
    'it'        => 'Italiano',
    'ja'        => '&#26085;&#26412;&#35486;',
    'ka'        => '&#4325;&#4304;&#4320;&#4311;&#4323;&#4314;&#4312;&#32;&#4308;&#4316;&#4304;',
    'kk'        => 'Қазақ',
    'kn'        => '&#57522;&#38368;&#45736;&#57523;&#36320;&#45736;&#57522;',
    'ko'        => '&#54620;&#44397;&#50612;',
    'ku'        => 'Kurd&#238;',
    'lg'        => 'Luganda;',
    'lt'        => 'Lietuvi&#371;',
    'lv'        => 'Latvie&#353;u',
    'mai'       => '&#2350;&#2376;&#2341;&#2367;&#2354;&#2368; &#2478;&#2504;&#2469;&#2495;&#2482;&#2496;',
    'mk'        => '&#1052;&#1072;&#1082;&#1077;&#1076;&#1086;&#1085;&#1089;&#1082;&#1080;',
    'ml'        => '&#3374;&#3378;&#3375;&#3390;&#3379;&#3330;',
    'mn'        => '&#1052;&#1086;&#1085;&#1075;&#1086;&#1083;',
    'mr'        => '&#2350;&#2352;&#2366;&#2336;&#2368;',
    'nb-NO'     => 'Norsk bokm&#229;l',
    'ne-NP'     => '&#2344;&#2375;&#2346;&#2366;&#2354;&#2368;',
    'nl'        => 'Nederlands',
    'nn-NO'     => 'Norsk nynorsk',
    'oc'        => 'occitan (lengadocian)',
    'or'        => 'ଓଡ଼ିଆ',
    'pa-IN'     => '&#2602;&#2672;&#2588;&#2622;&#2604;&#2624;',
    'pl'        => 'Polski',
    'pt-BR'     => 'Portugu&#234;s (do Brasil)',
    'pt-PT'     => 'Portugu&#234;s (Europeu)',
    'rm'        => 'Rumantsch',
    'ro'        => 'Rom&#226;n&#259;',
    'ru'        => '&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;',
    'rw'        => 'Ikinyarwanda',
    'si'        => '&#3523;&#3538;&#3458;&#3524;&#3517;',
    'sk'        => 'Sloven&#269;ina',
    'sl'        => 'Slovensko',
    'son'       => 'Soŋay',
    'sq'        => 'Shqip',
    'sr'        => '&#1089;&#1088;&#1087;&#1089;&#1082;&#1080;',
    'sv-SE'     => 'Svenska',
    'ta'        => '&#2980;&#2990;&#3007;&#2996;&#3021;',
    'ta-LK'     => 'Tamil (Sri Lanka)',
    'te'        => '&#57520;&#42208;&#45446;&#57520;&#45792;&#45441;&#57520;&#38880;&#45441;',
    'th'        => '&#3616;&#3634;&#3625;&#3634;&#3652;&#3607;&#3618;',
    'tr'        => 'T&#252;rk&#231;e',
    'uk'        => '&#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072;',
    'vi'        => 'Tiếng Việt',
    'zh-CN'     => '&#20013;&#25991; (&#31616;&#20307;)',
    'zh-TW'     => '&#27491;&#39636;&#20013;&#25991; (&#32321;&#39636;)',
    'zu'        => 'isiZulu'
);


/**
 * All the languages we support.  They won't show up on the site unless they are in
 * this array.  This array needs to have all languages, even if they are being
 * remapped.
 */
$full_languages = array(
    'af',
    'ak',
    'ar',
    'as',
    'ast',
    'be',
    'br',
    'bg',
    'bn-IN',
    'bn-BD',
    'bs', // Remap to en-US
    'ca',
    'cs',
    'cy',
    'da',
    'de',
    'el',
    'en', // Remap to en-US
    'en-GB',
    'en-US',
    'en-ZA',
    'eo',
    'es', // Remap to es-ES
    'es-AR',
    'es-ES',
    'es-CL',
    'es-MX',
    'et',
    'eu',
    'fa',
    'fi',
    'fr',
    'fy-NL',
    'ga-IE',
    'gd',
    'gl',
    'gu-IN',
    'he',
    'hi-IN',
    'hr',
    'hu',
    'hy',
    'hy-AM',
    'id',
    'is',
    'it',
    'ja',
    'ja-JP-mac', // Remap to ja
    'ka',
    'kk',
    'kn',
    'ko',
    'ku',
    'lg',
    'lt',
    'lv',
    'mai',
    'mk',
    'ml',
    'mn',
    'mr',
    'nb-NO',
    'nl',
    'nn-NO',
    'no', // Remap to nb-NO
    'nso', // remap to en-US for now, potential Fx4
    'oc',
    'or',
    'pa-IN',
    'pl',
    'pt', // Remap to pt-PT
    'pt-BR',
    'pt-PT',
    'rm',
    'ro',
    'ru',
    'si',
    'sk',
    'sl',
    'son',
    'sq',
    'sr',
    'sv', // Remap to sv-SE
    'sv-SE',
    'ta',
    'ta-LK',
    'te',
    'th',
    'tr',
    'uk',
    'vi',
    'zh-CN',
    'zh-TW',
    'zu', // remap to en-US
);

/**
 * If we support a locale but want to redirect it to another, add it to this array.
 * Format:
 *      lowercase(requested_language) => mapped_language
 */
$lang_remap = array(
    'bs'        => 'en-US',
    'en'        => 'en-US',
    'es'        => 'es-ES',
    'ja-jp-mac' => 'ja',
    'no'        => 'nb-NO',
    'pt'        => 'pt-PT',
    'sv'        => 'sv-SE',
    'hy'        => 'hy-AM',
    'zu'        => 'en-US',

);

/*** TEMPORARY CODE ***/
/**
 * A mapping between the short name for the language and the URL for where it's files
 * are.  This is a temporary measure, while we localize pages and move them from
 * external servers to mozilla.com.  As languages are migrated to mozilla.com, change
 * them in this array to point to mozilla.com.  When all the locales in this list
 * point to mozilla.com delete the array and remove the corresponding section marked
 * "TEMPORARY CODE" in prefetch.php.
 */
$language_url_map = array(
    'af'        => 'http://www.mozilla.com/af/',
    'ak'        => 'http://www.mozilla.com/ak/',
    'ar'        => 'http://www.mozilla.com/ar/',
    'as'        => 'http://www.mozilla.com/as/',
    'ast'       => 'http://www.mozilla.com/ast/',
    'be'        => 'http://www.mozilla.com/be/',
    'bg'        => 'http://www.mozilla-europe.org/bg/',
    'bn-BD'     => 'http://www.mozilla.com/bn-BD/',
    'bn-IN'     => 'http://www.mozilla.com/bn-IN/',
    'br'        => 'http://www.mozilla.com/br/',
    'ca'        => 'http://www.mozilla-europe.org/ca/',
    'cs'        => 'http://www.mozilla-europe.org/cs/',
    'cy'        => 'http://www.mozilla.com/cy/',
    'da'        => 'http://www.mozilla-europe.org/da/',
    'de'        => 'http://www.mozilla-europe.org/de/',
    'el'        => 'http://www.mozilla-europe.org/el/',
    'en-ZA'     => 'http://www.mozilla.com/en-ZA/',
    'eo'        => 'http://www.mozilla.com/eo/',
    'es'        => 'http://www.mozilla-europe.org/es/',
    'es-AR'     => 'http://www.mozilla.com/es-AR/',
    'es-CL'     => 'http://www.mozilla.com/es-CL/',
    'es-ES'     => 'http://www.mozilla-europe.org/es/',
    'es-MX'     => 'http://www.mozilla.com/es-MX/',
    'et'        => 'http://www.mozilla.com/et/',
    'eu'        => 'http://www.mozilla-europe.org/eu/',
    'en-GB'     => 'http://www.mozilla-europe.org/en/',
    'en-US'     => 'http://www.mozilla.com/en-US/',
    'fa'        => 'http://www.mozilla.com/fa/',
    'fi'        => 'http://www.mozilla-europe.org/fi/',
    'fr'        => 'http://www.mozilla-europe.org/fr/',
    'fy-NL'     => 'http://www.mozilla.com/fy-NL/',
    'ga-IE'     => 'http://www.mozilla.com/ga-IE/',
    'gd'        => 'http://www.mozilla.com/gd/',
    'gl'        => 'http://www.mozilla.com/gl/',
    'gu-IN'     => 'http://www.mozilla.com/gu-IN/',
    'he'        => 'http://www.mozilla.com/he/',
    'hi-IN'     => 'http://www.mozilla.com/hi-IN/',
    'hr'        => 'http://www.mozilla.com/hr/',
    'hu'        => 'http://www.mozilla-europe.org/hu/',
    'hy-AM'     => 'http://www.mozilla.com/hy-AM/',
    'id'        => 'http://www.mozilla.com/id/',
    'is'        => 'http://www.mozilla.com/is/',
    'it'        => 'http://www.mozilla-europe.org/it/',
    'ja'        => 'http://mozilla.jp/',
    'ka'        => 'http://www.mozilla.com/ka/',
    'kk'        => 'http://www.mozilla.com/kk/',
    'kn'        => 'http://www.mozilla.com/kn/',
    'ko'        => 'http://www.mozilla.or.kr/',
    'ku'        => 'http://www.mozilla.com/ku/',
    'lg'        => 'http://www.mozilla.com/lg/',
    'lt'        => 'http://www.mozilla-europe.org/lt/',
    'lv'        => 'http://www.mozilla.com/lv/',
    'mk'        => 'http://www.mozilla.com/mk/',
    'ml'        => 'http://www.mozilla.com/ml/',
    'mr'        => 'http://www.mozilla.com/mr/',
    'nl'        => 'http://www.mozilla-europe.org/nl/',
    'no'        => 'http://www.mozilla-europe.org/no/',
    'nb-NO'     => 'http://www.mozilla-europe.org/no/',
    'nso'       => 'http://www.mozilla.com/nso/',
    'oc'        => 'http://www.mozilla.com/oc/',
    'pa-IN'     => 'http://www.mozilla.com/pa-IN/',
    'pl'        => 'http://www.mozilla-europe.org/pl/',
    'pt-BR'     => 'http://www.mozilla.com/pt-BR/',
    'pt-PT'     => 'http://www.mozilla-europe.org/pt/',
    'rm'        => 'http://www.mozilla.com/rm/',
    'ro'        => 'http://www.mozilla-europe.org/ro/',
    'ru'        => 'http://www.mozilla-europe.org/ru/',
    'sk'        => 'http://www.mozilla-europe.org/sk/',
    'si'        => 'http://www.mozilla.com/si/',
    'sl'        => 'http://www.mozilla.com/sl/',
    'son'       => 'http://www.mozilla.com/son/',
    'sq'        => 'http://www.mozilla-europe.org/sq/',
    'sr'        => 'http://www.mozilla-europe.org/sr/',
    'sv-SE'     => 'http://www.mozilla-europe.org/sv/',
    'ta'        => 'http://www.mozilla.com/ta/',
    'ta-LK'     => 'http://www.mozilla.com/ta-LK/',
    'te'        => 'http://www.mozilla.com/te/',
    'th'        => 'http://www.mozilla.com/th/',
    'tr'        => 'http://www.mozilla-europe.org/tr/',
    'uk'        => 'http://www.mozilla-europe.org/uk/',
    'vi'        => 'http://www.mozilla.com/vi/',
    'zh-TW'     => 'http://www.moztw.org/',
    'zh-CN'     => 'http://www.mozillaonline.com/',
);

/* Despite our having in-product pages for all the languages above, we don't have
 * full site translations for all of them.  We can't have them all showing up in the
 * footer language select box then, because we wouldn't know where to send them.  So,
 * these languages are the ones that will show up in the footer select box.  As site
 * translations become available, copy the language from $native_languages to this
 * array.  When this array and $native_languages are the same, delete this array, and
 * change the getLangLinksSelect() function in includes/functions.inc.php to run off
 * $native_languages. */
$language_select_list = array(
    'af'        => 'Afrikaans',
    'ak'        => 'Akan',
    'ar'        => '&#1593;&#1585;&#1576;&#1610;',
    'as'        => '&#2437;&#2488;&#2478;&#2496;&#2479;&#2492;&#2494;',
    'ast'       => 'Asturianu',
    'be'        => 'Беларуская',
    'bg'        => '&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;',
    'bn-BD'     => 'বাংলা (বাংলাদেশ)',
    'bn-IN'     => '&#2476;&#2494;&#2434;&#2482;&#2494;',
    'br'        => 'Brezhoneg',
    'bs'        => 'Bosanski',
    'ca'        => 'Catal&#224;',
    'cs'        => '&#268;e&#353;tina',
    'cy'        => 'Cymraeg',
    'da'        => 'Dansk',
    'de'        => 'Deutsch',
    'el'        => '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;',
    'en-ZA'     => 'English (South African)',
    'eo'        => 'Esperanto',
    'es-AR'     => 'Espa&#241;ol (Argentina)',
    'es-CL'     => 'Espa&#241;ol (Chile)',
    'es-ES'     => 'Espa&#241;ol (Espa&#241;a)',
    'es-MX'     => 'Espa&#241;ol (México)',
    'et'        => 'Eesti keel',
    'eu'        => 'Euskara',
    'en-GB'     => 'English (British)',
    'en-US'     => 'English (US)',
    'fa'        => '&#1601;&#1575;&#1585;&#1587;&#1740;',
    'fi'        => 'Suomi',
    'fr'        => 'Fran&#231;ais',
    'fy-NL'     => 'Frysk',
    'ga-IE'     => 'Gaeilge',
    'gd'        => 'Gàidhlig',
    'gl'        => 'Galego',
    'gu-IN'     => '&#2711;&#2753;&#2716;&#2736;&#2750;&#2724;&#2752;',
    'he'        => '&#1506;&#1489;&#1512;&#1497;&#1514;',
    'hi-IN'     => '&#2361;&#2367;&#2344;&#2381;&#2342;&#2368; (&#2349;&#2366;&#2352;&#2340;)',
    'hy-AM'     => '&#1344;&#1377;&#1397;&#1381;&#1408;&#1381;&#1398;',
    'hr'        => 'Hrvatski',
    'hu'        => 'Magyar',
    'id'        => 'Bahasa Indonesia',
    'is'        => '&#205;slenska',
    'it'        => 'Italiano',
    'ja'        => '&#26085;&#26412;&#35486;',
    'ka'        => '&#4325;&#4304;&#4320;&#4311;&#4323;&#4314;&#4312;&#32;&#4308;&#4316;&#4304;',
    'kk'        => 'Қазақ',
    'kn'        => '&#57522;&#38368;&#45736;&#57523;&#36320;&#45736;&#57522;',
    'ko'        => '&#54620;&#44397;&#50612;',
    'ku'        => 'Kurd&#238;',
    'lg'        => 'Luganda',
    'lt'        => 'Lietuvi&#371;',
    'lv'        => 'Latvie&#353;u',
    'mk'        => '&#1052;&#1072;&#1082;&#1077;&#1076;&#1086;&#1085;&#1089;&#1082;&#1080;',
    'ml'        => '&#3374;&#3378;&#3375;&#3390;&#3379;&#3330;',
    'mr'        => '&#2350;&#2352;&#2366;&#2336;&#2368;',
    'nl'        => 'Nederlands',
    'no'        => 'Norsk bokm&#229;l',
    'nso'       => 'Sepedi',
    'oc'        => 'occitan (lengadocian)',
    'pa-IN'     => '&#2602;&#2672;&#2588;&#2622;&#2604;&#2624;',
    'pl'        => 'Polski',
    'pt-BR'     => 'Portugu&#234;s (do Brasil)',
    'pt-PT'     => 'Portugu&#234;s (Europeu)',
    'rm'        => 'Rumantsch',
    'ro'        => 'Rom&#226;n&#259;',
    'ru'        => '&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;',
    'sk'        => 'Sloven&#269;ina',
    'si'        => '&#3523;&#3538;&#3458;&#3524;&#3517;',
    'sl'        => 'slovensko',
    'son'       => 'Soŋay',
    'sq'        => 'Shqip',
    'sr'        => '&#1057;&#1088;&#1087;&#1089;&#1082;&#1080;',
    'sv-SE'     => 'Svenska',
    'ta'        => '&#2980;&#2990;&#3007;&#2996;&#3021;',
    'ta-LK'     => 'Tamil (Sri Lanka)',
    'te'        => '&#57520;&#42208;&#45446;&#57520;&#45792;&#45441;&#57520;&#38880;&#45441;',
    'th'        => '&#3616;&#3634;&#3625;&#3634;&#3652;&#3607;&#3618;',
    'tr'        => 'T&#252;rk&#231;e',
    'uk'        => '&#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072;',
    'vi'        => 'Tiếng Việt',
    'zh-CN'     => '&#20013;&#25991; (&#31616;&#20307;)',
    'zh-TW'     => '&#27491;&#39636;&#20013;&#25991; (&#32321;&#39636;)',
    'zu'        => 'isiZulu',
);
/*** END TEMPORARY CODE ***/
?>
