<?php

    $body_id    = 'channel';
    $body_class = 'locale-'.$lang;
    require_once $config['file_root'].'/includes/product-details/mobileDetails.class.php';
    require_once $config['file_root'].'/includes/feeds/RapidReleaseFeed.php';
    $extra_headers .= <<<EXTRA_HEADERS
    <link href="{$config['static_prefix']}/style/covehead/mobile-m.css" rel="stylesheet" media="all" />

EXTRA_HEADERS;

    $download_link = str_replace('<em>', '<br/><em>', $download_link);

    require_once $config['file_root'].'/includes/l10n/m-header-pages.inc.php';

?>

<div class="page-title with-titles">
  <h2><?php echo $main_title; ?></h2>
</div>

<div class="content-box with-titles">
  <div class="title">
    <h1><?php echo $beta; ?></h1>
    <h3><?php echo $mobile; ?></h3>
  </div>
  <ul>
    <li><?php echo $slogan1; ?></li>
    <li><?php echo $slogan2; ?></li>
  </ul>

  <a href="<?= mobileDetails::download_url($lang, mobileDetails::android, mobileDetails::beta_version) ?>" class="button">
    <?php echo $download_link; ?>
  </a>
</div>

<h2><?php echo $blog_title; ?></h2>

<ul class="blog-feed">
<?php
   $feed = new RapidReleaseFeed();
   $items = $feed->getItems(4);

   foreach($items as $item) {
?>

  <li>
    <a href="<?= htmlspecialchars($item['link']); ?>">
      <?= htmlspecialchars($item['title']) ?>
    </a>
    <span class="date">
      <?= htmlspecialchars(date('F j, Y', $item['date'])) ?>
<?php
      if (count($item['categories']) > 0) {
          echo ' • ';
          $categories = array_map('htmlspecialchars', $item['categories']);
          echo implode(', ', $categories);
      }
?>
    </span>
  </li>

<?php
   }
?>
</ul>

<a class="blog" href="http://blog.mozilla.com/futurereleases/"><?php echo $blog_link; ?></a>



<?php
    require_once $config['file_root'].'/includes/l10n/m-footer-pages.inc.php';
?>
