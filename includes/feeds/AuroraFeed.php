<?php

require_once dirname(__FILE__) . '/RapidReleaseFeed.php';

/**
 * @package   MozillaCom
 * @author    Steven Garrrity <steven@silverorange.com>
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2011 Mozilla Foundation, 2011 silverorange
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt Mozilla Public License
 */
class AuroraFeed extends RapidReleaseFeed
{
    protected function getURI()
    {
        return 'http://blog.mozilla.com/futurereleases/category/aurora/feed/';
    }
}

?>
