<?php

require_once dirname(__FILE__) . '/AbstractFeed.php';

/**
 * @package   MozillaCom
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    James Long
 * @copyright 2011 Mozilla Foundation, 2011 silverorange
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt Mozilla Public License
 */
class RapidReleaseFeed extends AbstractFeed
{
    protected function getURI()
    {
        return 'http://blog.mozilla.com/futurereleases/feed/';
    }

    public function getItems($limit = 4)
    {
        $xpath = $this->getDOMXPath($this->getURI());
        $items = array();

        if ($xpath !== null) {
            $item_els = $xpath->query('//item');
            $count = 0;
            foreach ($item_els as $item_el) {
                $item = array();
                $item['title'] = $xpath->evaluate('string(title/text())', $item_el);
                $item['link'] = $xpath->evaluate('string(link/text())', $item_el);
                $item['date'] = strtotime($xpath->evaluate('string(pubDate/text())', $item_el));
                $categories = array();
                $category_els = $xpath->query('category/text()', $item_el);
                foreach ($category_els as $category) {
                    $categories[] = $category->data;
                }
                $item['categories'] = $categories;
                $items[] = $item;
                $count++;

                if ($count >= $limit) {
                    break;
                }
            }
        }

        return $items;
    }
}

?>
