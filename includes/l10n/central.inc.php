<?php

    $body_id = 'central';
    $html5   = true;

    if(!isset($extra_headers)) {$extra_headers = '';}
    if(!isset($extra_css))     {$extra_css     = '';}

    $extra_headers .= <<<EXTRA_HEADERS
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tignish/getting-started.css" media="screen" />
EXTRA_HEADERS;


    $extra_css .= <<<EXTRA_CSS
    #wrapper {
        background: none !important;
    }

    #main-feature {
        min-height: 140px !important;
        margin: 20px !important;
    }

    .gettingstarted-feature-contents .try-this {
        background: none !important;
    }

    .gettingstarted-feature-contents  {
        padding: 0 25px !important;
        height: 400px;

    }

    .js #gettingstarted-feature {
        background: none !important;
    }

    .js #gettingstarted-nav li {

        background:none !important;
        min-height:40px;
    }

    .pager-content {
        -moz-border-radius: 8px;
        background: url("/img/firefox/3.6/firstrun/background-footer.png"), url("/img/firefox/3.6/firstrun/yeti-top.png");
        background-repeat: repeat, no-repeat;
        background-position:50% 0, 100% 100%;
        background-color: transparent, transparent;
        padding: 0 0 20px;
        margin-bottom:20px;
        padding: 0 0 60px;
    }
    

    #gettingstarted-nav li a {
        border:none !important;
        padding: 0 50px 0 10px !important;
        text-shadow: 1px 0 3px #AFD2FF;
    }

    [dir=rtl] #gettingstarted-nav li {
        float: right;
    }

    .col1, .col2 {
        -moz-border-radius: 8px 8px 8px 8px;
        -moz-box-shadow: -3px -3px 5px #EAF4FF;
        padding: 10px;
        min-height:370px;
    }

    .col1 {
        margin-right: 35px;
    }

    .col2 {
        margin-right: 0px;
    }

    #central #firefox-info, #central #mozilla-info {
        background-image: none !important;
        padding: 0 0 20px 80px;
        text-align: center;
    }

    #central #firefox-info h3, #central #mozilla-info h3 {
        background:none !important;
        font-family: MetaBlack,"Trebuchet MS",sans-serif !important;
        font-size: 150% !important;
        font-style: normal  !important;
        font-weight: bold !important;
        letter-spacing: -0.02em !important;
        text-transform: uppercase !important;
        line-height: inherit !important;
    }


    #central #firefox-info {
        background: url("/img/covehead/about/icon-press.png") no-repeat scroll 20px 0px transparent !important;
    }


    #central #mozilla-info {
        background: url("/img/covehead/about/icon-careers.png") no-repeat scroll right 0px transparent !important;
        padding-right: 100px;
    }




    #central h3, #central h3{
        color: #303030 !important;
        font-family: georgia,serif !important;
        font-style: italic !important;
        font-weight: normal !important;
        background: url("/img/home/intro-shape.png") no-repeat scroll top center #FFFFFF !important;
        height: 60px !important;
        line-height: 50px !important;
        text-align: center !important;
        padding-top:0 !important;
        padding-bottom:0 !important;
    }

    #central h4 {
        margin:0 !important;
        clear:both !important;
    }

    .gettingstarted-feature-contents h4 a img {
        padding: 0 0 0 2px !important;
    }

    .gettingstarted-feature-contents p {
        margin-bottom: 1em !important;
    }

EXTRA_CSS;

    $extra_footers = <<<EXTRA_FOOTERS
    <script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/js/mozilla-pager.js"></script>
EXTRA_FOOTERS;

    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
