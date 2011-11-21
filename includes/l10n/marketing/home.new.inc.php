<?php

$str2  = str_replace('4', '', $str2);
$str2  = str_replace('&nbsp;', '', $str2);
$speed = '';

if ( i__('Super speed') == true) {
    $speed = '<li>' . ___('Super speed') . '</li>';
}

$footerfile = '';

?>

<script>// <![CDATA[
    // Add a class to the body tag to alternate background features
    var feature_class_options    = new Array( "facebook", "cupcake", "treasure" );
    var feature_platform_options = new Array( "", "mac", "linux" );

    var feature_platform = '';
    if (gPlatform == PLATFORM_MACOSX) {
        feature_platform = '-mac';
    } else if (gPlatform == PLATFORM_LINUX) {
        feature_platform = '-linux';
    }

    if (Math.random) {
        var choice = Math.floor(Math.random() * (feature_class_options.length));

        // Just in case javascript gets carried away...
        choice = ( (choice < feature_class_options.length)  && choice >= 0) ? choice : 0;

    }
// ]]></script>

<div id="main-feature">
    <h2><?php echo $str2 ?></h2>

    <?php if($promo): ?>
    <ul id="benefits">
        <li class="first"><?php echo $str4 ?></li>
        <li><?php echo $str6 ?></li>
        <?php echo $speed ?>
    </ul>
    <?php else: ?>
    <hr style="margin-bottom:3em; height:0; border:0; color:transparent; background-color:transparent">
    <?php endif; ?>

    <div id="screenshot">
    <noscript><img src="<?=$config['static_prefix']?>/img/covehead/firefox/main-feature-facebook.png" alt="Firefox screenshot" class="screenshot"></noscript>
    <script>
        var image = document.createElement('img');
        image.src = '<?=$config['static_prefix']?>/img/covehead/firefox/main-feature-' + feature_class_options[choice] + feature_platform + '.png';
        image.alt = 'Firefox screenshot';
        image.className  = 'screenshot';
        document.getElementById('screenshot').appendChild(image);
    </script>
    </div>

<?=$downloadbox?>
<p id="mobile-promo"><a href="<?=$host_l10n;?>/mobile/"><?=___('Firefox for mobile')?></a></p>
</div>
<?php

// Webtrends stats, see bug 556384
require $config['file_root'] . '/includes/js_stats.inc.php';

// Persistent Upgrade messaging, only display if it is translated
require "{$config['file_root']}/includes/l10n/upgrade-messaging.inc.php";


$press_link = "";
if(in_array($lang, array('fr', 'de', 'it', 'pl', 'es-ES', 'en-GB'))) {
    l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/press.lang');
    $press_link = <<<PRESS_LINK
    &nbsp;|&nbsp;<a href="{$host_l10n}/press/">{$l10n->get('Press')}</a>
PRESS_LINK;
}


$dynamic_footer = <<<DYNAMIC_FOOTER

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    <!-- start #footer -->
        <div class="footer-links">
            <a href="{$host_l10n}/firefox/features/">{$l10n->get('Desktop')}</a>&nbsp;|&nbsp;
            <a href="{$host_l10n}/firefox/mobile/">{$l10n->get('Mobile')}</a>&nbsp;|&nbsp;
            <a href="https://addons.mozilla.org/">{$l10n->get('Add-ons')}</a>&nbsp;|&nbsp;
            <a href="http://support.mozilla.com/">{$l10n->get('Support')}</a>&nbsp;|&nbsp;
            <a href="{$host_l10n}/about/">{$l10n->get('About')}</a>
            {$press_link}
        </div>

    <!-- end #footer -->
    {$stats_js}
    {$extra_footers}

    {$upgrade_warning}

</body>
</html>
DYNAMIC_FOOTER;


echo $dynamic_footer;

unset($dynamic_footer);
?>
