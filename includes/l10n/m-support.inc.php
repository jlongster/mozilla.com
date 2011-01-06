<?php

/* Variables and functions needed only on the customize mobile page */

$body_id = 'home';

$sumo_links = array(
    0  => "http://support.mozilla.com/$lang/mobile",
    1  => "http://support.mozilla.com/$lang/kb/sync-firefox-between-desktop-and-mobile",
    2  => "http://support.mozilla.com/$lang/kb/upgrade-firefox",
    3  => "http://support.mozilla.com/$lang/kb/how-do-i-use-awesome-screen",
    4  => "http://support.mozilla.com/$lang/kb/change-preferences",
    5  => "http://support.mozilla.com/$lang/kb/mobile-keyboard-shortcuts",
    6  => "http://support.mozilla.com/$lang/kb/manage-downloads",
    7  => "http://support.mozilla.com/$lang/kb/open-new-tab",
    8  => "http://support.mozilla.com/$lang/kb/find-and-install-add-ons",
    9  => "http://support.mozilla.com/$lang/kb/remove-or-disable-add-ons",
    10 => "http://support.mozilla.com/$lang/kb/surf-web-with-mobile-firefox",
    11 => "http://support.mozilla.com/$lang/kb/how-do-i-add-bookmark",
    12 => "http://support.mozilla.com/$lang/kb/zoom-in-and-out",
);


$extra_headers .= <<<EXTRA_HEADERS
    <link href="{$config['static_prefix']}/style/mobile/support.css" rel="stylesheet" media="all" />
    
EXTRA_HEADERS;

// RTL support
if ($textdir == 'rtl') {
    $extra_headers  .= <<<EXTRA_HEADERS
    {$extra_headers}
    <style type="text/css">
    #support-search .submit {
        -moz-transform: scale(-1, 1);
    }

    #support-search .wrap {
        float: right !important;
    }
    
    ul.highlight li a {
        background: url("/img/mobile/support/disclosure-indicator-rtl.png") no-repeat scroll left center transparent !important;
    }
    </style>


EXTRA_HEADERS;
}


$sumo_field_link = sprintf($link_to_sumo,$sumo_links[0]);

$searchbox = <<<SEARCHBOX
    <div id="support-search">
        <form method="get" action="http://support.mozilla.com/{$lang}/search">
            <span class="wrap">
                <input class="text" required="required" placeholder="{$search_field}" name="q">
                <input type="hidden" name="os" value="4">
                <input type="hidden" name="os" value="5">
                <input type="hidden" name="fx" value="4">
            </span>
            <input type="image" alt="{$search_button}" title="{$search_button}" src="{$config['static_prefix']}/img/mobile/support/btn.mobilesearch.png" class="submit">
        </form>
        <span class="ancillary">{$sumo_field_link}</span>
    </div>
SEARCHBOX;





include_once "{$config['file_root']}/includes/l10n/m-header-pages.inc.php";

?>