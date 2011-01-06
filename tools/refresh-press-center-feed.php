<?php
/**
 * This script does the following:
 *
 *  - Fetch the main RSS feed from blog.mozilla.com;
 *  - Use SimplePie to parse the feed;
 *  - Build a simplified array of feed items;
 *  - Write the array out as a static PHP include for the en-US press center;
 *      - en-US/press/includes/feed.php
 */
$blog_feed_url = 'http://blog.mozilla.com/feed/';
include_once dirname(__FILE__) . "/../includes/config.inc.php";

include_once dirname(__FILE__) . "/../includes/simplepie_1.2/simplepie.inc";

$feed = new SimplePie();
$feed->set_feed_url($blog_feed_url);
$feed->enable_cache(false);
$feed->init();

$feed_items = array();
foreach ($feed->get_items() as $item) {
    $item_data = array(
        'title'       => $item->get_title(),
        'date'        => $item->get_date('F j, Y'),
        'dateISO8601' => $item->get_date('c'),
        'link'        => $item->get_permalink(),
        'summary'     => $item->get_description()
    );
    $feed_items[] = $item_data;
}

file_put_contents(
    dirname(__FILE__) . "/../en-US/press/includes/feed.php",
    '<'.'?php $feed_items = ' . var_export($feed_items, true) . ';'
);
