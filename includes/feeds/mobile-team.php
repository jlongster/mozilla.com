<?php
/** Pulls simple JSON data from FriendFeed.  
  * Memcache the data for an hour, if available, otherwise just pull the feed.
  */
include_once dirname(__FILE__) ."/../config.inc.php";

$disable_feed_cache = true;

// pull 5 items
// API docs here: http://friendfeed.com/api/documentation
$feed_url = 'http://friendfeed-api.com/v2/feed/firefoxmobile?num=5&raw=1';
$feed = null;

$cache = $disable_feed_cache ? false : memcache_factory($config['memcache']);
$feed_obj_key = 'mobile-team-feed';

if ($cache) {
    $feed = $memcache->get($feed_obj_key);
} 

if (!$feed) {
    $handle = fopen($feed_url, "rb");
    $json = stream_get_contents($handle);
    fclose($handle);
    $feed = json_decode($json);
    if ($cache) {
        $cache->set($feed_obj_key, $feed, 3600);
    }
}

/**
  * Turn link strings into <a> tags.
  * Helpful for bit.ly links in Twitter statuses.
  */
function linkify($input) {
    // The Regular Expression filter
    $pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

    // convert URLs into Links
    return preg_replace($pattern, "<a href=\"\\0\" rel=\"nofollow\">\\0</a>", $input);
}

function memcache_factory($config) {
    if(class_exists('Memcache') && is_array($config)) {

        $_memcache = new Memcache();

        foreach ($config as $host=>$options) {
            //Using connect() because addserver() does not tell us if we connected to
            //any memcache servers. We want to degrade gracefully.
            if ($_memcache->connect($host, $options['port'], $options['timeout'])) {
                return $_memcache;
            }
        }
    }
    return false;
}
