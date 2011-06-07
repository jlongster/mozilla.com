
<div id="main-feature">
    <h2><?php e__('Mozilla Firefox. Bringing the modern Web to XP.'); ?></h2>

    <?php if($promo): ?>
    <ul id="benefits">
        <li><em>&raquo;</em><?php e__('Super speed');?></li>
        <li><em>&raquo;</em><?php e__('Stunning graphics');?></li>
        <li><em>&raquo;</em><?php e__('The latest technologies');?></li>
    </ul>
    <?php else: ?>
    <hr style="margin-bottom:3em; height:0; border:0; color:transparent; background-color:transparent">
    <?php endif; ?>

    <div id="screenshot">
        <img src="/img/l10n/main-feature.png" alt="Firefox screenshot" class="screenshot" />


        <?=$windowmessage;?>
    </div>

<?=$downloadbox?>

</div>

<div id="main-content">

    <div class="sub-feature first">
        <h3><?php e__('Features');?></h3>
        <p><?php e__('Check out the new look and feel of Firefox&nbsp;4.');?><a href="./features/"><?php e__('Learn More');?></a></p>
    </div>

    <div class="sub-feature">
        <h3><?php e__('Add-ons');?></h3>
        <p><?php e__('Customize with Add-ons');?><a href="./customize/"><?php e__('Learn More');?></a>
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

        <p><?=$main_slogan;?><a href="./mobile/"><?php e__('Learn More');?></a>
        </p>
    </div>

</div>




