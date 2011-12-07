<?php

// get a few UI strings and metadata for this project
l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/firefoxflicks.lang');

switch($pageid) {
    default:
    case 'firefoxflicks':
        $folder      = '';
        $body_id     = 'firefoxflicks';
        $return_home = '';
        break;
    case 'firefoxflicks-brief':
        $folder      = 'brief/';
        $body_id     = 'firefoxflicks-brief';
        $return_home = '<a href="../" class="home">' . ___('« Return Home') . '</a>';
        $link = array(
            0 => 'http://www.mozilla.org/en-US/firefox/brand/platform/',
            1 => 'http://www.mozilla.org/en-US/firefox/brand/',
            2 => 'mailto:firefoxflicks@mozilla.org',
            3 => 'http://popcornjs.org/',
        );
        break;
    case 'firefoxflicks-faq':
        $folder      = 'faq/';
        $body_id     = 'firefoxflicks-faq';
        $return_home = '<a href="../" class="home">' . ___('« Return Home') . '</a>';
        $link = array(
            0 => '../brief/',
            1 => 'mailto:firefoxflicks@mozilla.org',
            2 => 'http://mozilla.org/en-US/firefox/brand/',
            3 => 'http://www.mozilla.org/foundation/trademarks/policy.html',
            4 => 'http://search.creativecommons.org/',
            5 => 'http://en.wikipedia.org/wiki/Public_domain',
        );
        break;
}

// Facebook locales
$fb_locale_codes= array(
    'af'     => 'af_ZA'  ,
    'ar'     => 'ar_AR'  ,
    'as'     => 'as_IN'  ,
    'ast'    => 'ast_ES' ,
    'be'     => 'be_BY'  ,
    'bg'     => 'bg_BG'  ,
    'bn-IN'  => 'bn_IN'  ,
    'bn-BD'  => 'bn_BD'  ,
    'br'     => 'br_FR'  ,
    'bs'     => 'bs_BA'  ,
    'ca'     => 'ca_ES'  ,
    'cs'     => 'cs_CZ'  ,
    'csb'    => 'csb_PL' ,
    'cy'     => 'cy_GB'  ,
    'da'     => 'da_DK'  ,
    'de'     => 'de_DE'  ,
    'el'     => 'el_GR'  ,
    'en-GB'  => 'en_GB'  ,
    'en-US'  => 'en_US'  ,
    'en-ZA'  => 'en_ZA'  ,
    'eo'     => 'eo_EO'  ,
    'es-AR'  => 'es_LA'  ,
    'es-ES'  => 'es_ES'  ,
    'es-CL'  => 'es_LA'  ,
    'es-MX'  => 'es_LA'  ,
    'et'     => 'et_EE'  ,
    'eu'     => 'eu_ES'  ,
    'fa'     => 'fa_IR'  ,
    'fi'     => 'fi_FI'  ,
    'fr'     => 'fr_FR'  ,
    'fy-NL'  => 'fy_NL'  ,
    'ga-IE'  => 'ga_IE'  ,
    'gd'     => 'en_GB'  , // not supported on Facebook
    'gl'     => 'gl_ES'  ,
    'gu-IN'  => 'gu_IN'  ,
    'he'     => 'he_IL'  ,
    'hi-IN'  => 'hi_IN'  ,
    'hr'     => 'hr_HR'  ,
    'hu'     => 'hu_HU'  ,
    'hy-AM'  => 'hy_AM'  ,
    'id'     => 'id_ID'  ,
    'is'     => 'is_IS'  ,
    'it'     => 'it_IT'  ,
    'ja'     => 'ja_JP'  ,
    'ka'     => 'ka_GE'  ,
    'kk'     => 'en_GB'  , // not supported on Facebook
    'kn'     => 'en_GB'  , // not supported on Facebook
    'ko'     => 'ko_KR'  ,
    'ku'     => 'ku_TR'  ,
    'lg'     => 'en_GB'  , // not supported on Facebook
    'lt'     => 'lt_LT'  ,
    'lv'     => 'lv_LV'  ,
    'mai'    => 'en_GB'  , // not supported on Facebook
    'mk'     => 'mk_MK'  ,
    'ml'     => 'ml_IN'  ,
    'mn'     => 'en_GB'  , // not supported on Facebook
    'mr'     => 'en_GB'  , // not supported on Facebook
    'nb-NO'  => 'nb_NO'  ,
    'nl'     => 'nl_NL'  ,
    'or'     => 'en_GB'  , // not supported on Facebook
    'pa-IN'  => 'pa_IN'  ,
    'pl'     => 'pl_PL'  ,
    'pt-BR'  => 'pt_BR'  ,
    'pt-PT'  => 'pt_PT'  ,
    'rm'     => 'en_GB'  , // not supported on Facebook
    'ro'     => 'ro_RO'  ,
    'ru'     => 'ru_RU'  ,
    'si'     => 'en_GB'  , // not supported on Facebook
    'sk'     => 'sk_SK'  ,
    'sl'     => 'sl_SI'  ,
    'son'    => 'en_GB'  , // not supported on Facebook
    'sq'     => 'sq_AL'  ,
    'sr'     => 'sr_RS'  ,
    'sv-SE'  => 'sv_SE'  ,
    'ta'     => 'ta_IN'  ,
    'ta-LK'  => 'en_GB'  , // not supported on Facebook
    'te'     => 'te_IN'  ,
    'th'     => 'th_TH'  ,
    'tr'     => 'tr_TR'  ,
    'uk'     => 'uk_UA'  ,
    'vi'     => 'vi_VN'  ,
    'zh-CN'  => 'zh_CN'  ,
    'zh-TW'  => 'zh_TW'  ,
    'zu'     => 'en_GB'  , // not supported on Facebook
);

$fb_locale = array_key_exists($lang, $fb_locale_codes) ? $fb_locale_codes[$lang] : 'en_US';

$lang_list          = getLangLinksSelect(array('en-US', 'fr',));
$lang_list          = str_replace(' (España)', '', $lang_list);
$lang_list          = str_replace(' (US)', '', $lang_list);
$current_year       = date('Y');
$extra_footers      = empty($extra_footers) ? '' : $extra_footers;
$extra_footer_links = empty($extra_footer_links) ? '' : $extra_footer_links;

require_once $config['file_root'] . '/includes/l10n/header-firefoxflicks.inc.php';

echo '    <section id="primary"><div class="container">';
echo $return_home;
require_once $config['file_root'] . '/' . $lang . '/firefoxflicks/' . $folder . 'content.inc.html';
echo '    </div></section>';

require_once $config['file_root'] . '/includes/l10n/footer-firefoxflicks.inc.php';

