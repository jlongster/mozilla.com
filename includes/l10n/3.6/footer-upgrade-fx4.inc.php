<?php

$details = $config['file_root'].'/'.$lang.'/firefox/4/details/index.html';
if(file_exists($details)) {
    $retour = true;
    $promo  = true;
    include $details;
} else {
    $promo = false;
    $str2 = 'Firefox 4';
}

?>

<div id="main-content" class="beta-promo">
   <h3><span><?php echo $str2 ?></span></h3>
    <p><?php echo $str3 ?></p>
    <ul>
        <li><?php echo $str4 ?></li>
        <li><?php echo $str6 ?></li>
        <li><?php echo $str5 ?></li>
    </ul>
    <ul class="link"><li>
        <a href="/<?=$lang?>/firefox/?WT.mc_id=ba3613&amp;WT.mc_ev=click"
           onclick="dcsMultiTrack('DCS.dcssip', 'www.mozilla.com',
                                  'DCS.dcsuri', '/<?=$lang?>/firefox/beta/',
                                  'WT.ti', 'Link: Try the Beta',
                                  'WT.dl', 99,
                                  'WT.nv', 'Content',
                                  'WT.ac', 'Beta');">
          <?php e__('Download');?>
        </a>
    </li></ul>
</div>

<p id="sub-links" style="position:static">
    <a href="/<?=$lang?>/firefox/<?=$_version?>/releasenotes/"><?php e__('Release Notes');?><span>»</span></a>
    <a href="/<?=$lang?>/firefox/features/"><?php e__('Features');?><span>»</span></a>
    <a href="http://support.mozilla.com"><?php e__('Support');?><span>»</span></a>
</p>
<?php


// Webtrends stats, see bug 556384
require "{$config['file_root']}/includes/js_stats.inc.php";

$inline_js_portal_footer = min_inline_js('js_portal_footer');
if (isset($detect_flash) && $detect_flash == TRUE)
{
    $inline_js_portal_footer .= min_inline_js('detect_flash');
}

$dynamic_footer = <<<DYNAMIC_FOOTER

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    {$stats_js}
    {$extra_footers}
    {$inline_js_portal_footer}
</body>
</html>
DYNAMIC_FOOTER;


echo $dynamic_footer;
unset($dynamic_footer);
