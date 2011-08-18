<?php

require_once $config['file_root'] . '/includes/feeds/AbstractFeed.php';

class RapidReleaseFeed extends AbstractFeed
{
    protected function getURI()
    {
        return 'http://blog.mozilla.com/futurereleases/feed/';
    }

    public function get_items($max_items = 4)
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

                if ($count >= $max_items) {
                    break;
                }
            }
        }

        return $items;
    }
}

?>
