<?php
    include_once "{$config['file_root']}/includes/product-details/mobileDetails.class.php";
?>

<?php if ($wurfl_device_supported): ?>

<h2><?= ___('Fully Localized Versions') ?></h2>
<table id="languages">
  <thead>
    <tr>
      <th colspan="2"><?= ___('Languages') ?></th>
      <th>Maemo</th>
    </tr>
  </thead>
  <tbody>
    <? foreach (mobileDetails::primary_builds() as $b): ?>
    <tr>
      <td><?= $b['locale']['english'] ?></td>
      <td lang="<?= $b['locale']['code'] ?>"><?= $b['locale']['native'] ?></td>
      <td><a href="<?= $b['download']['maemo'] ?>" title="<?= ___('Download') ?>"><?= ___('Download') ?></a></td>
    </tr>
    <? endforeach; ?>
  </tbody>
</table>

<? endif ?>
