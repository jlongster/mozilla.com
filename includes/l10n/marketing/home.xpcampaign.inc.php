
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
        <img src="<?=$config['static_prefix'];?>/img/covehead/firefox/main-feature-xp2.png" alt="Firefox screenshot" class="screenshot" />

        <?=$windowmessage;?>
    </div>

<?=$downloadbox?>

</div>

<div id="main-content">

    <div class="sub-feature first">
        <h3><?php e__('Features');?></h3>
        <p><?php e__('Check out the new look and feel of Firefox.');?><a href="./features/"><?php e__('Learn More');?></a></p>
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

<!-- measure tag -->
<IFRAME
SRC="http://media.mozilla.com/ipixel?spacedesc=1121943_1061349_1x1_1061349_1061349&db_afcr=123&target=_blank&group=Mozilla&event=LandingPage&revenue=REVENUE&random=CACHEBUSTER"
     WIDTH="1" HEIGHT="1" SCROLLING="No" FRAMEBORDER="0" MARGINHEIGHT="0" MARGINWIDTH="0">
<![if lt IE 5]>
<SCRIPT
SRC="http://media.mozilla.com/jpixel?spacedesc=1121943_1061349_1x1_1061349_1061349&db_afcr=123&target=_blank&group=Mozilla&event=LandingPage&revenue=REVENUE&random=CACHEBUSTER"></SCRIPT>
<![endif]>
</IFRAME>
