<?php

require_once $config['file_root'] . '/includes/feeds/rapidrelease.php';

class AuroraFeed extends RapidReleaseFeed
{
    protected function getURI()
    {
        return 'http://blog.mozilla.com/futurereleases/category/aurora/feed/';
    }

}

?>
