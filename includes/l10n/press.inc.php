<?php
require_once "{$config['file_root']}/includes/feeds/PressFeed.php";
l10n_moz::load($config['file_root'] . '/'. $lang.'/includes/l10n/press.lang');

    $body_id    = 'press';
    $extra_headers = <<<EXTRA_HEADERS
    <link rel="stylesheet" href="{$config['static_prefix']}/style/covehead/press-page.css" media="screen" />
EXTRA_HEADERS;

require_once $config['file_root'].'/includes/l10n/header-pages.inc.php';
?>
<div id="main-feature">
	<h2><span><?= $l10n->get('Press');?></span></h2>
</div>

<div id="main-content">
	<h3><?= $l10n->get('Latest Press Releases')?></h3>
<?php
$feed = new PressFeed();
$items = $feed->getItems(20, $lang);

if (count($items) > 0) {
   echo '<ul>';

   foreach ($items as $item) {
       echo '<li>';
       echo '<h4><a href="' . htmlspecialchars($item['link']) . '">';
       echo htmlspecialchars($item['title']);
       echo '</a></h4>';
       echo '<div class="info">';
       echo '<span class="date">' . htmlspecialchars(date('F j, Y', $item['date'])) . '</span>';
       if (count($item['categories']) > 0) {
           echo ' • ';
           $categories = array_map('htmlspecialchars', $item['categories']);
           echo implode(', ', $categories);
       }
       echo '</div>';
       echo '</li>';
   }

   echo '</ul>';
}
?>
</div>
<?php
require_once $config['file_root'].'/includes/l10n/footer-pages.inc.php';
