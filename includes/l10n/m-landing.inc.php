<?php

/* Variables and functions needed only on the customize mobile page */

$body_id = 'home';

include_once $config['file_root'].'/includes/product-details/mobileDetails.class.php';
$version           = mobileDetails::latest_version;
$url_release_notes = mobileDetails::release_notes_url($version);
$dl_android        = mobileDetails::download_url('en-us', mobileDetails::android, $version);
$dl_maemo          = mobileDetails::download_url('en-us', mobileDetails::maemo, $version);

// reuse some of the strings we had for beta
$retour = true;
include_once $config['file_root'].'/'.$lang.'/m/beta.html';
$main_slogan = str_replace('.', '', $main_slogan);
if(!isset($list_devices)) {
    $list_devices = 'List of Supported Devices';
}

$downloadbox = <<<BUTTON
    <div class="button-wrapper">
      <img class="up-corner" src="/img/mobile/m/up-corner.png" />
      <div class="buttons">
        <a href="{$dl_android}" class="button">Android <em>{$l10n->get('Free Download')}</em></a>
        <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>

    <div class="center-link">
      <a href="/{$lang}/mobile/platforms/">{$list_devices} »</a>
    </div>
BUTTON;




$extra_headers .= <<<EXTRA_HEADERS
	<script>
	// FIXME : Ugly detection for Firefox for tablets
	// See bug 699289
	if (navigator.platform.indexOf("armv7l") != -1 && navigator.userAgent.indexOf("Firefox") != - 1 && screen.width > 700) {
		location = location.protocol + '//' + location.host + '/firefox/?mobile_no_redirect=1';
	}
	</script>
    <link href="{$config['static_prefix']}/style/covehead/mobile-m.css" rel="stylesheet" media="all" />
    <style>
    .title .text {
        margin-right: 100px;
    }
    </style>
EXTRA_HEADERS;

// RTL support
if ($textdir == 'rtl') {
    $extra_headers  .= <<<EXTRA_HEADERS
    <style>

    </style>


EXTRA_HEADERS;
}

$links = <<<LINKS
    <ul class="link-list">
      <li><a href="{$url_release_notes}">{$l10n->get('Release Notes')}</a></li>

      <li><a href="/m/faq">{$l10n->get('FAQ')}</a></li>
      <li><a href="/m/privacy.html">{$l10n->get('Privacy Policy')}</a></li>
    </ul>
LINKS;


include_once $config['file_root'].'/includes/l10n/m-header-pages.inc.php';
include_once $config['file_root'].'/'.$lang.'/m/index.inc.html';
include_once $config['file_root'].'/includes/l10n/m-footer-pages.inc.php';
