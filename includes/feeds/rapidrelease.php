<?php

require_once $config['file_root'] . '/includes/Cache/Lite.php';

class RapidReleaseFeed
{
    public function get_items($max_items = 4)
    {
        $uri = 'http://blog.mozilla.com/futurereleases/feed/';
        $lifetime = 450; // 7.5 mins, about half static cache time

        $document = new DOMDocument();
        $items = array();

        $cache = new Cache_Lite(
            array(
                'cacheDir' => dirname(__FILE__) . '/../../../cache/',
                'lifeTime' => $lifetime,
            )
        );

        if (($xml = $cache->get($uri)) === false) {
            $xml = $this->downloadFeed($uri);
            if ($xml === false) {
                // try invalid cached version if it exists
                if (($xml = $cache->get($uri, 'default', true)) === false) {
                    $xml = '';
                }
            } else {
                $cache->save($xml, $uri);
            }
        }

        if ($xml != '') {
            $document->loadXML($xml);
            $xpath = new DOMXPath($document);
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

    protected function downloadFeed($uri)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $uri);
        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($status != 200) {
            $response = false;
        }
        return $response;
    }
}

?>
