<?php

/**
 * Extra HTML head content for the "First Run" page for Firefox 3.6.x
 *
 * CSS and JavaScript should be included here as long as they are not
 * language-specific.
 */

// The $body_* variables are for compatibility with pre-existing css
$body_id    = 'plugin-check';
$body_class = '';
$message[12] = ''; // string removed

$extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/tignish/plugin-check.css" media="screen" />
EXTRA_HEADERS;

$url_prefix = $config['url_scheme'] . '://' . $config['server_name'];



$PluginCheckL10n = "\n".'<script type="text/Javascript">'."\n";
$PluginCheckL10n .= "/* <![CDATA[ */\n";
$PluginCheckL10n .= "Pfs_external    = [];\n";

foreach($message as $key => $str)
{
  $PluginCheckL10n .= "Pfs_external[$key] = \"$str\";\n";
}



$PluginCheckL10n .= <<<EXTRA_JS
// create Pfs_internal array to avoid JS error, need to know what the real name of the array will be in the library
Pfs_internal = [];

if (typeof Pfs_external != 'undefined' && Pfs_external.length && typeof Pfs_internal != 'undefined' )
{
  for (var i = 0; i < Pfs_external.length; i++)
  {
    if (typeof Pfs_external[i] != 'undefined')
    {
      Pfs_internal[i] = Pfs_external[i];
    }
  }
}

EXTRA_JS;

$PluginCheckL10n .= "/* ]]> */\n";
$PluginCheckL10n .= "\n".'</script>'."\n";

/* Bug#535030 TODO: Order we include footer-portal-pages and our plugincheck is sensative.
                    Work on no-conflict jQuery for web badge and no jQuery for moco */
$extra_footers = <<<EXTRA_FOOTERS
<script src="/includes/min/min.js?g=js"></script>
<script src="/js/plugincheck.js"></script>
<script>
/* <![CDATA[ */
Pfs.$(document).ready(function(){
    checkPlugins('
EXTRA_FOOTERS;
$extra_footers .= $config['pfs_endpoint']; #from includes/config.inc.php
$extra_footers .= <<<EXTRA_FOOTERS
');
    Pfs.$('#web-badge-code').bind('click.badge', function(){
      Pfs.$(this).select().unbind('click.badge');
    });
});
/* ]]> */
</script>
EXTRA_FOOTERS;

$PluginTable = <<<MYTABLE
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
            <img class="icon" src="" alt="Plugin Icon" />
            <h4 class="name"><a href="#"></a></h4><span class="version"></span>
          </td>
          <td class="status"><span class="copy"></td>
          <td class="action"><a class="button"><span></span></a></td>
        </tr>
      </tbody>
    </table>

                <!-- BEGIN qTip HTML -->
                <div class="qtip qtip-stylename">
                   <div class="qtip-tip" rel="cornerValue"></div>
                   <div class="qtip-wrapper">
                      <div class="qtip-borderTop"></div>
                      <div class="qtip-contentWrapper">
                         <div class="qtip-title"> <!-- All CSS styles...-->
                            <div class="qtip-button"></div> <!-- ...are usually applied... -->
                         </div>
                         <div class="qtip-content"></div> <!-- ...to these three elements! -->
                      </div>
                      <div class="qtip-borderBottom"></div>
                   </div>
                </div>
                <!-- END qTip HTML -->


MYTABLE;



include_once "{$config['file_root']}/includes/l10n/header-pages.inc.php";

?>




