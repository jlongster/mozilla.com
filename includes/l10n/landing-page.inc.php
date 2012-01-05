<?php

$body_id = 'home';

$extra_headers .= <<<EXTRA_HEADERS
    <meta property="og:image" content="http://mozcom-cdn.mozilla.net/img/firefox-100.jpg" />
    <meta name="description" content="{$meta_description}" />
    <link rel="canonical" href="{$config['url_scheme']}://{$config['server_name']}/{$lang}/firefox/">

EXTRA_HEADERS;


$extra_css = <<<EXTRA

        #home body {
            background-image: url("/img/covehead/firefox/direct/page-background.png");
        }
        #home #header {
            margin-bottom: 0 !important;
        }
        #home #main-feature {
            zoom: 1 !important;
        }
        #home #main-feature h2 {
            line-height: 50px !important;
            padding: 60px 0 0 0 !important;
            font-style: italic !important;
            width: 420px !important;
        }
        #home #main-feature img.screenshot {
            top: auto !important;
            bottom: 0 !important;
        }
        #home #main-feature img.second-screenshot {
            opacity: 0;
        }

        #home ul#benefits {
            min-height: 40px !important;
        }
        #home ul#benefits li {
            font-size: 18px !important;
            width:120px !important;
            padding: 0 10px !important;
            margin-bottom: 5px!important;
        }
        #home .download-other {
            text-align: center !important;
            width: 350px !important;
        }
        #home .sub-feature.first {
            background: none !important;
        }
        #home .sub-feature {
            width: 250px !important;
            padding-top: 0!important;
            padding-bottom: 100px!important;
            padding-left: 60px !important;
            padding-right: 20px !important;
        }

        #home #sub-security.sub-feature {
            padding-right: 0px !important;
        }

        #home .sub-feature h3 {
            font-size:25px !important;
        }

EXTRA;


// fallback download page
$target   = 'normal';

$home_css = '<link rel="stylesheet" href="' . $config['static_prefix'] . '/style/covehead/l10n/landing-page.css" media="screen" />';

if (count($_GET) > 0) {

    $getArray = secureText($_GET);
    $getArray = array_keys($getArray);

    // new vs fx
    if ( in_array('fx', $getArray) || in_array('new', $getArray) ) {

        $target = ( in_array('new', $getArray) ) ? 'new' : 'normal';

        // do we have an fx page for this locale or do we keep the fallback ?
        if( $target == 'normal' && in_array( $lang, array('de', 'es-ES', 'fr')) ) {
            $target = 'fx';
        }

        // do we have a brand awareness campaign page or do we keep the regular download page ?
        if( $target == 'new' && in_array( $lang, $brand_aware_locales) ) {
            $target = 'newbranding';
        }
    }
}

// define download box on the page
include $config['file_root'].'/includes/l10n/dlbox.inc.php';

switch($target) {

    case 'new':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.new.inc.php';
        $extra_css .= <<<EXTRA

        html {
            background-color: white;
        }

        #home #doc {
            margin-bottom: 0 !important;
        }

        #home #header h1 a {
            display:none !important;
        }

         #home #mobile-promo {
            color: #6D7581;
            font-size: 13px;
            margin: 0;
            padding: 15px 30px 0px 60px;
            text-align: right;
            width: 240px;
        }

        #home ul#benefits {
            font-size: 22px;
            font-style: italic;
            padding: 0;
            margin: 10px 0 20px 0;
        }

        #home ul#benefits li {
            float: left;
            margin: 0 0 40px 0;
            list-style-type: none;
            text-align: center;
            padding: 8px 20px;
            line-height: 19px;
            color: #484848;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAMAAAAwCAMAAADjGDCOAAAAElBMVEXq6urAwMDBwcHp6en29vb///+NcJSLAAAAPElEQVQI12WOwQ0AMQzCTAL7r9zfXZM+LUsGLHA1SUiCq7G4GKzfJ8FqXEzWaowmyzM31O+Hm9fHr1F9AMllAhxqMpx9AAAAAElFTkSuQmCC") 0 6px no-repeat;
            *background-image: url('/img/covehead/firefox/dotted-divider.png'); /* IE6 and IE7 only */
        }

        #home ul#benefits li.first {
            padding-left: 5px;
            background: none;
            margin-top: 0.5em;
        }

        #home ul#benefits li span {
            display: block;
        }

        #home ul#benefits {
            min-height: 40px !important;
        }

        #home ul#benefits li {
            font-size: 18px !important;
            width:120px !important;
            padding: 0 10px !important;
            margin-bottom: 5px!important;
        }

        #home #home-download {
            clear: left;
            padding-left: 0;
            position: relative;
            z-index: 25;
            margin-top:40px;
        }

EXTRA;

        break;

    case 'newbranding':
        $headerfile  = '';
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.newbranding.inc.php';
        $footerfile  = '';
        break;

    case 'fx':
        $contentfile = $config['file_root'].'/includes/l10n/marketing/home.mobilefx.inc.php';
        $extra_css = '';
        $body_id = 'home-fx';
        $home_css = '<link rel="stylesheet" href="/style/covehead/home-fx.css" media="screen" />';
        require_once "{$config['file_root']}/includes/helpers.php";
        include_once "{$config['file_root']}/includes/product-details/mobileDetails.class.php";
        $_options = array('ancillary_links' => true, 'layout' => 'subpage', 'download_parent_override' => 'home-fx-download', '_include_js' => true, 'download_product' => 'Firefox');
        $l10n->load($config['file_root'].'/'.$lang.'/includes/l10n/mobile.lang');
        $extra_css .= <<<EXTRA
            ul.home-download li a.download-link #download-arrow,
            ul.home-download li a.download-link .download-arrow {
                display: none !important;
            }

            #main-content .sub-feature a:after {
                content:"»";
            }

            #main-content #sub-firefox a:after {
                content:"";
            }

            #home-fx #main-feature h3 {
                font-size: 57px;
                letter-spacing: -0.05em;
                line-height: 0.9;
                display: block;
                font-family: MetaBlack,"Trebuchet MS",sans-serif;
                font-style: normal;
                font-weight: bold;
                text-transform: uppercase;
            }
EXTRA;
        $android_relnotes = '/' .$lang . mobileDetails::release_notes_url(mobileDetails::latest_version);
        $android_market_download = <<<EXTRA
            <a href="https://market.android.com/details?id=org.mozilla.firefox"
            id="mobile-download"
             onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.org',
                                    'DCS.dcsuri', '/mobile/download/',
                                    'WT.ti', 'Link: Get Firefox for Android',
                                    'WT.dl', 99,
                                    'WT.nv', 'Content',
                                    'WT.ac', 'Get Firefox for Android',
                                    'WT.z_convert','Get Firefox for Android',
                                    'WT.si_n','Get Firefox for Android',
                                    'WT.si_x','2')">

            <span class="title">{$l10n->get('Get Firefox for Android')}</span>
            <span class="desc">{$l10n->get('Free from the Android Market')}</span>
            <img alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAZCAYAAAArK+5dAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH2wkPFAMGOD/JMQAAAy1JREFUSMeNlU9oFUccxz+z2bdGUmwlARs0tJe2YJo0FBQ8hWqLBNJi/0ChR6EBtXrwKPaQ9uShILTG0ktvASWlh7Y+DyKY0ohCoaFW25oiIagJSfXlT9283Z0ZD/tm3s7uvqQDj/m93+z8ft/5/r7zGwHQ/97xes/rBwLKhlYgvHKfO0fAdWAC+Oan04ciAG+sOl0HAiUTzE8raW2llOPTSqK1dtYac6BkMqhk8qVW8sbQ6MROAA8ILCqtUlPrJtLGrJW0s1bSPY35zrrkAFAdGp0I/CIj6WYhhPPfDONHK7TWCCFSQFpaWwiBVrIPGPFtoCxq4dnAnh/w0eBu3ni1h65t7TbRahgzM1/j26t3mH246IDRGlObD30TOItUq8QiHTk4wP6+XQC889lFi3Di1Af09nRy8u0BTnx92QJsnjxBCLHXN05TvAwXAPS/2MXDx/8RRpIzh9/CazB0b2GZLZU2Kn5bBrm2+xp24BvenOAZyuJE8sm5H2k1vjo27OzN235BMbkkiVSla/l1Q53xG9tSpGR5EKl0yzWAWDbXNRn0Dds3GfNyNCNKUu1bOeYTJLLlXpugFUUAiTIUlAeQWrfc61BkCp1HGiXKEUGe5yhRKLVJgixFeaSJVO4d0Tj2RiJwKNJKNrtmsbc07oZXXMtLPNdpHYoE7ubs0dNTpjfc0KSUQiptZdqkzkhf4ly0gkq0oh6nbdqcLv9dIhs1yCDPhvEz3a+Uw3os+fTj9wFoD3w8kRa+HqetJYwzMtXFGJ4QAuG1IaOwNMHs0ipLq+t88d0v/Lsa8vn4NR6trXP2+ylqTyKm/nzg1iVXIzFWna6P/3AlCGuLbHnm2UIhtz63gz39r9C9vYOtlTZbr5Uw4vbcI/7+47emCnNPqxACH/j1hZd79936+RKV9g48332DwtoCk5ML/K9RUFj6ZF7Y+9LzdHR2Ey4vIuO4tCWUddpWvqztAecrnvh9+OCbdHR2s76yRLRWQ0Z1R13mvcjKMa8+x2683QJgrDq9UwhRjaTqu3l3nrl//qJ2f6bQNlo1vI3WhTHGqtMBcAR4FxjciKLNEplxdOg18RQ29owjgk9YIAAAAABJRU5ErkJggg==">
        </a>
        <div class="download-other"><a href="{$android_relnotes}">{$l10n->get('Release Notes')}</a> | <a href="/{$lang}/mobile/platforms">{$l10n->get('Supported Devices')}</a></div>
EXTRA;

        $links = array(
            0 =>"https://affiliates.mozilla.org/$lang/",
            1 => "/$lang/newsletter/",
        );

        foreach($links as $key => $val) {
            $links[$key] = ' href="' . $val . '"';
        }

        break;
    case 'normal':
    default:
        $contentfile = $config['file_root'].'/includes/l10n/4/fallback.home.inc.php';
        $extra_css = '';
        break;
}


// we extract a few strings from another project
$retour  = true;
$details = $config['file_root'].'/'.$lang.'/firefox/4/details/index.html';
if (file_exists($details)) {
    $promo = true;
    include $details;
} else {
    $promo = false;
    $str2  = 'Firefox';
}


$extra_headers .= <<<EXTRA_HEADERS

    {$home_css}

EXTRA_HEADERS;


// we test if the variables exists because including chunks of pages
if ($headerfile != '' && file_exists($headerfile)) {
    include_once $headerfile;
}

if ($contentfile != '' && file_exists($contentfile)) {
    include_once $contentfile;
}

if ($footerfile != '' && file_exists($footerfile)) {
    include_once $footerfile;
}


