<?php

// temporary include

l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/firefoxlive.lang');


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

$lang_list          = getLangLinksSelect(array( 'ar', 'de', 'en-US', 'es-ES', 'fr', 'rm', 'zh-TW' ));
$lang_list          = str_replace(' (España)', '', $lang_list);
$lang_list          = str_replace(' (US)', '', $lang_list);
$current_year       = date('Y');
$extra_footers      = empty($extra_footers) ? '' : $extra_footers;
$extra_footer_links = empty($extra_footer_links) ? '' : $extra_footer_links;
$creative_commons   = sprintf(___('Except where otherwise <a href="%s">noted</a>, content on this site is licensed under the <br /><a href="%s">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.'),"/$lang/about/legal.html#site", 'http://creativecommons.org/licenses/by-sa/3.0/');
$creative_commons   = str_replace('<br />', '', $creative_commons);
