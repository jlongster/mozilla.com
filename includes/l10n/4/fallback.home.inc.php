<?php

$str2  = str_replace('4', '', $str2);
$str2  = str_replace('&nbsp;', '', $str2);
$speed = '';

if ( i__('Super speed') == true) {
    $speed = '<li><em>&raquo;</em>' . ___('Super speed') . '</li>';
}


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
        <li><em>&raquo;</em><?php echo $str4 ?></li>
        <li><em>&raquo;</em><?php echo $str6 ?></li>
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

</div>

<div id="main-content">

    <div class="sub-feature first">
        <h3><?php e__('Features');?></h3>
        <p><?php e__('Check out the new look and feel of Firefox.');?><a href="../features/"><?php e__('Learn More');?></a></p>
    </div>

    <div class="sub-feature">
        <h3><?php e__('Add-ons');?></h3>
        <p><?php e__('Customize with Add-ons');?><a href="../customize/"><?php e__('Learn More');?></a>
        </p>
    </div>

    <div class="sub-feature">
        <h3><?php e__('Mobile');?></h3>

<?php
    $mobilestrings = $config['file_root'].'/'.$lang.'/m/beta.html';
    if(file_exists($mobilestrings)) {
        $retour = true;
        include $mobilestrings;
    } else {
        $str1 = 'Firefox';
        $main_slogan = '';
    }
?>

        <p><?=$main_slogan;?><a href="../mobile/"><?php e__('Learn More');?></a>
        </p>
    </div>

</div>




