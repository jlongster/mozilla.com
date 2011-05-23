<?php
    $body_id    = 'webhero';
        
    if(!isset($extra_headers)) {$extra_headers = '';}
    if(!isset($extra_css))     {$extra_css     = '';}
    
    include_once "{$config['file_root']}/includes/js_stats.inc.php";
    l10n_moz::load($config['file_root'].'/includes/l10n/gettext_externals/webhero/'.$lang.'/LC_MESSAGES/messages.po', 'po');    
    
    $extra_headers .= <<<EXTRA_HEADERS
        <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/webhero.css" media="screen">
        <script src="{$config['static_prefix']}/includes/min/min.js?g=js&amp;2011-05-20"></script>
        <script type="text/javascript" src="{$config['static_prefix']}/js/jquery/jquery.nyroModal.pack.js"></script>
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <script src="{$config['static_prefix']}/js/html5.js"></script>
        <![endif]-->
                
        
EXTRA_HEADERS;


    $extra_css .= <<<EXTRA_CSS
        #webhero #copyright {
            font-size: 100% !important;
            margin: 0 !important;    
        }
EXTRA_CSS;

    $extra_footers = <<<EXTRA_FOOTERS
EXTRA_FOOTERS;

    require "{$config['file_root']}/includes/l10n/header-pages.inc.php";
?>
