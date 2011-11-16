<?php
/* Full webtrends example code:

<!-- START OF SmartSource Data Collector TAG -->
<!-- Copyright (c) 1996-2010 WebTrends Inc.  All rights reserved. -->
<!-- Version: 8.6.2 -->
<!-- Tag Builder Version: 3.0  -->
<!-- Created: 3/29/2010 4:04:57 PM -->
<script src="/scripts/webtrends.js"></script>
<!-- ----------------------------------------------------------------------------------- -->
<!-- Warning: The two script blocks below must remain inline. Moving them to an external -->
<!-- JavaScript include file can cause serious problems with cross-domain tracking.      -->
<!-- ----------------------------------------------------------------------------------- -->
<script>
//<![CDATA[
var _tag=new WebTrends();
_tag.dcsGetId();
//]]>>
</script>
<script>
//<![CDATA[
// Add custom parameters here.
//_tag.DCSext.param_name=param_value;
_tag.dcsCollect();
//]]>>
</script>
<noscript>
<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="http://statse.webtrendslive.com/dcso6de4r0000082npfcmh4rf_4b1e/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=8.6.2"/></div>
</noscript>
<!-- END OF SmartSource Data Collector TAG -->
*
*/
?>
<?php
// Prepare Stats block, unless disabled for this page
if (!empty($disable_js_stats)) {
    $stats_js = '';
} else {
    // tracking codes for firstrun vs. regular pages
    if (false !== strpos($_SERVER["REQUEST_URI"], 'firstrun') ||
        false !== strpos($_SERVER["REQUEST_URI"], 'whatsnew') ||
        false !== strpos($_SERVER["REQUEST_URI"], 'firefox/central')) {
        $wt_options = array(
            'dcsid' => 'dcst2y3n900000gohmphe66rf_3o6x',
            'rate' => 5,
            'fpcdom' => 'mozilla.org'
        );
    } else {
        $wt_options = array(
            'dcsid' => 'dcsf9nqmj10000clgc14f05rf_2u7t',
            'rate' => 50,
            'fpcdom' => 'mozilla.org'
        );
    }
    $opt_json = json_encode($wt_options);

    if (!empty($auto_link_tracking)) {
        $auto_link_output = '_tag.trackevents=true;';
    } else {
        $auto_link_output = '';
    }

    $stats_js = <<<STATS_JS
<script type="text/javascript" src="{$config['static_prefix']}/includes/min/min.js?g=js_stats"></script>
<script type="text/javascript">
//<![CDATA[
var _tag=new WebTrends({$opt_json});
_tag.dcsGetId();
//]]>
</script>
<script>
//<![CDATA[
{$auto_link_output}
_tag.dcsCollect();
//]]>
</script>
<noscript>
<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="//statse.webtrendslive.com/dcso6de4r0000082npfcmh4rf_4b1e/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=8.6.2"/></div>
</noscript>
STATS_JS;
}
