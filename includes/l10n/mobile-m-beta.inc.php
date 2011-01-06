<?php
    $body_id    = 'home';
    $body_class = 'locale-'.$lang;
    require_once "{$config['file_root']}/{$lang}/includes/mobile-header.inc.php";
?>
<style type="text/css">
.download-button .button-beta {
    min-width:300px;
    max-width:440px;
}

.locale-fr .button-beta {
    width:420px;
}

</style>
<div id="head">
  <h1><img src="/img/mobile/m/logo-welcome.png" alt="<?php echo $welcome_logo;?>" /></h1>
  <p><?php echo $main_slogan;?></p>
</div>

<div class="download-button">
  <a href="<?= mobileDetails::download_url($lang, mobileDetails::android, mobileDetails::beta_version) ?>" class="button button-beta">
    <span><?php echo $link_android;?> <em><?php echo $sub_link;?></em></span>
  </a>
</div>

<div class="download-button">
  <a href="<?= mobileDetails::download_url($lang, mobileDetails::maemo, mobileDetails::beta_version) ?>" class="button button-beta">
    <span><?php echo $link_maemo;?> <em><?php echo $sub_link;?></em></span>
  </a>
</div>

<ul class="ancillary">
  <li><a href="/<?= $lang ?>/mobile/<?php echo mobileDetails::beta_version; ?>/releasenotes/"><?php e__('Release Notes'); ?></a></li>
  <li><a href="/<?= $lang ?>/mobile/platforms/"><?php echo $list_devices; ?></a></li>
</ul>

<?php
    $link1 = "<a href='/{$lang}/mobile/beta/faq/'>".___('FAQ')."</a>";
    require_once "{$config['file_root']}/{$lang}/includes/mobile-footer.inc.php";
?>
