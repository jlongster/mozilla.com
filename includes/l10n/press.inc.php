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
	<h2>Mozilla <span><?= $l10n->get('Press Center');?></span></h2>
	<p><?= $l10n->get('Mozilla News, Announcements and More');?></p>
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
</div><!-- end #main-content div -->

<div id="sidebar">

  <?php include "{$config['file_root']}/{$lang}/press/includes/sidebar.php"; ?>
  
  <div id="sidebar-box">
    <h3><?= $l10n->get('Connect <span>with Us</span>');?></h3>
    <ul class="social">
        <li class="twitter"><a href="http://twitter.com/Firefox">Twitter »</a></li>
        <li class="flickr"><a href="http://www.flickr.com/photos/firefox_community">Flickr »</a></li>
        <li class="facebook"><a href="http://www.facebook.com/Firefox">Facebook »</a></li>
        <li class="feed"><a href="http://blog.mozilla.com/feed/"><?= $l10n->get('Subscribe to RSS feed »');?></a></li>
    </ul>

    <h3><?= $l10n->get('Media <span>Contact</span>');?></h3>
    <p><?= $l10n->get('For interview requests or any other media inquiries, please contact:');?></p>
    <p><em><?= $l10n->get('press at mozilla dot com');?></em></p>
  </div>

</div>

<?php
require_once $config['file_root'].'/includes/l10n/footer-pages.inc.php';
