<?php

$body_id     = 'plugin-check';
$message[12] = ''; // string removed, extra check


// dl box
include_once $config['file_root'].'/includes/l10n/dlbox.inc.php';

$extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/plugin-check.css" media="screen" />

    <style>

    html[lang='de'] #main-feature h2 {
        font-size: 40px;
    }

    html[lang='hu'] #main-feature h2 span {
        font-size: 57px;
    }

    html[lang='lt'] #main-feature h2 {
        font-size: 32px;
    }

    #sidebar {
        margin-left: 40px;
    }


    #plugin-check #doc {
        background: url("/img/covehead/plugincheck/background.png") no-repeat scroll 370px 36px transparent;
    }
    </style>

EXTRA_HEADERS;

if($textdir == "rtl") {
    $extra_headers .= <<<EXTRA_HEADERS
    <style>
        [dir="rtl"] #plugin-check #doc {
            background: url(/img/covehead/plugincheck/background-rtl.png) 190px 36px no-repeat;
        }

        [dir="rtl"] #main-feature {
            margin: 0 20px 0 210px;
        }

        [dir="rtl"] #main-content,
        [dir="rtl"] #main-feature h2,
        [dir="rtl"] #main-feature p {
            margin-left: 0;
            margin-right: 0;
        }

        [dir="rtl"] #download.top-right {
            right: auto;
            left: 10px;
        }

        [dir="rtl"] #main-content #content-left,
        [dir="rtl"] #main-content #sidebar,
        [dir="rtl"] #column-one,
        [dir="rtl"] #column-two {
            float: right;
        }

        [dir="rtl"] #sidebar {
            margin-left: 0;
            margin-right: 30px;
        }

        [dir="rtl"] #information-content .return-link, .badge-content .return-link {
            padding-left: 15px;
            text-align: left;
        }

        [dir="rtl"] #column-one, .left-column {
            margin-left: 40px;
        }
    </style>
EXTRA_HEADERS;
}

/*
$url_prefix = $config['url_scheme'] . '://' . $config['server_name'];
*/

$temp_strings = '';

foreach ($message as $key => $str) {
    $temp_strings .= "Pfs_external[$key] = \"$str\";\n";
}

$pluginCheckL10n = <<<EXTRA_JS
<script type="text/Javascript">
//<![CDATA[

Pfs_external = [];
{$temp_strings}
// create Pfs_internal array to avoid JS error, need to know what the real name of the array will be in the library
Pfs_internal = [];

if (typeof Pfs_external != 'undefined' && Pfs_external.length && typeof Pfs_internal != 'undefined' ) {
  for (var i = 0; i < Pfs_external.length; i++) {
    if (typeof Pfs_external[i] != 'undefined') {
      Pfs_internal[i] = Pfs_external[i];
    }
  }
}


console.log(Pfs_external, Pfs_internal);

//]]>
</script>

EXTRA_JS;


/* Bug#535030 TODO: Order we include footer-portal-pages and our plugincheck is sensative.
                    Work on no-conflict jQuery for web badge and no jQuery for moco */

$extra_footers = <<<EXTRA_FOOTERS
<script src="/includes/min/min.js?g=js"></script>
<script src="/js/plugincheck.js"></script>

<script>
//<![CDATA[
Pfs.$(document).ready(function(){
    checkPlugins('${config['pfs_endpoint']}');
    //TODO make this based on classes AND ids for clearning event handlers
    Pfs.$('.web-badge-code').bind('click.badge', function(){
      Pfs.$(this).select().unbind('click.badge');
    });
    if (!document.referrer ||
        location.href.indexOf('flash=1') > 0) {
        if (! PluginDetect.getVersion('Flash')) {
            $('.blocklisted.flash').show();
        }
    }
});
//]]>
</script>
EXTRA_FOOTERS;

$pluginsTable = <<<MYTABLE
    <table class="status">
      <thead>
            <tr>
                <th>{$tableHeader[1]}</th>
                <th>{$tableHeader[2]}</th>
                <th class="action">{$tableHeader[3]}</th>
            </tr>
      </thead>

      <tfoot>
            <tr class="link-row">
                <td colspan="3"></td>
            </tr>
      </tfoot>

      <tbody>
            <tr class="link-row">
                <td id="pfs-status" colspan="3"></td>
            </tr>
            <tr id="plugin-template" style="display: none">
                  <td>
                        <img class="icon" src="{$config['static_prefix']}/img/tignish/plugincheck/icon-flip.png" alt="Plugin Icon" />
                        <h4 class="name"><a href="#"></a></h4><span class="version"></span>
                  </td>
                  <td class="status"><span class="copy"></td>
                  <td class="action"><a class="button"><span></span></a></td>
            </tr>
      </tbody>

    </table>

MYTABLE;


$backtotop = '<div class="return-link"><a href="#">' . ___('Return to top') . '</a></div>';

$link = array();
$link[0]  = 'href="' . 'http://get.adobe.com/flashplayer/' . '"';
$link[1]  = 'href="' . 'http://lwn.net/Articles/262570/' . '"';
$link[2]  = 'href="' . '#what-plugin' . '"';
$link[3]  = 'href="' . '#why-update' . '"';
$link[4]  = 'href="' . '#firefox-helps' . '"';
$link[5]  = 'href="' . '#list-plugins' . '"';
$link[6]  = 'href="' . '#howto-disable' . '"';
$link[7]  = 'href="' . 'http://support.mozilla.com' . '"';
$link[8]  = 'href="' . 'http://support.mozilla.com/' . $lang . '/kb/Troubleshooting+plugins' . '"';
$link[9]  = 'href="' . 'http://adobe.com/' . '"';
$link[10] = 'href="' . 'http://www.apple.com/' . '"';
$link[11] = 'href="' . 'http://support.mozilla.com/kb/Popular+Plugins' . '"';

$screenshot = '<img class="screenshot" src="/img/covehead/plugincheck/screenshot.jpg" alt="" />';


require_once $config['file_root'].'/includes/l10n/header-pages.inc.php';
echo $downloadbox;
require_once $config['file_root'].'/'.$lang.'/plugincheck/content.inc.html';
echo $pluginCheckL10n;
require_once $config['file_root'].'/includes/l10n/footer-pages.inc.php';


