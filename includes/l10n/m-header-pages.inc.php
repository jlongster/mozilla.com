<?php


// RTL support for Mozilla.com mobile pages
if ($textdir == 'rtl') {
    $extra_headers  .= <<<EXTRA_HEADERS
    {$extra_headers}
    <style type="text/css">
    #view-full-site {
        left: 0;
        right: auto !important;
    }
    #firefox-logo {
        background: url("/img/mobile/support/firefox-logo.png") no-repeat scroll 99% center transparent !important;
        padding: 0.5em 100px 0 0 !important;
    }
    </style>


EXTRA_HEADERS;
}

// inline util.js since it's such a small file it doesn't deserver an http call
ob_start();
include "{$config['file_root']}/js/util.js";
$util_js = ob_get_contents();
ob_end_clean();


if (isset($html5) && $html5 == true) {
    $doctype = <<<DOCTYPE
<!DOCTYPE HTML>
<html xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
DOCTYPE;
} elseif (isset($transitional) && $transitional == true) {
    $doctype = <<<DOCTYPE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
DOCTYPE;
} else {
    $doctype = <<<DOCTYPE
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">
DOCTYPE;
}


$dynamic_header = <<<DYNAMIC_HEADER
{$doctype}
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
    <title>{$page_title}</title>
    
    <style type="text/css">
    {$extra_css}
    </style>

    {$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class} locale-{$lang} {$textdir}">


<div class="wrapper">

    <div id="header">
        <a href="/{$lang}/m/" id="firefox-logotype"><img src="{$config['static_prefix']}/img/mobile/support/firefox-logotype.gif" alt="Firefox"/></a>
        <a href="{$sumo_links[0]}" id="view-full-site">{$l10n->get("View Full Site")}</a>
    </div>

    <!-- end #header -->


DYNAMIC_HEADER;

$creative_commons   = sprintf(___('Except where otherwise <a href="%s">noted</a>, content on this site is licensed under the <br /><a href="%s">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.'),"/$lang/about/legal.html#site", 'http://creativecommons.org/licenses/by-sa/3.0/');

$footer = <<<FOOTER
</div> <!-- end .wrapper -->

<div id="lower">
    <div class="wrapper">
        <div id="footer">
            <a href="{$sumo_links[0]}" class="button">{$l10n->get("View Full Site")}</a>
            <p>{$creative_commons}</p>
        </div>
    </div> <!-- end .wrapper -->
</div> <!-- end #lower -->
    
FOOTER;


echo $dynamic_header;
unset($dynamic_header);

?>
