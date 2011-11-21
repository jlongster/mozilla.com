<?php

require_once dirname(__FILE__) . '/AbstractFeed.php';

/**
 * @package   MozillaCom
 * @author    Anthony Ricaud
 * @copyright 2011 Mozilla Foundation
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt Mozilla Public License
 */
class PressFeed extends AbstractFeed
{
    protected function getURI()
    {
        return 'http://www.mozilla-europe.org/' . $this->lang . '/news.rdf';
    }

    public function getItems($limit = 4, $lang)
    {
        $this->lang = $lang;
        $doc = $this->getDOMDocument($this->getURI());
        $items = array();

        if ($doc !== null) {
            $item_els = $doc->getElementsByTagName('item');
            $count = 0;
            foreach ($item_els as $item_el) {
                $item = array();
                $item['title'] = $item_el->getElementsByTagName('title')->item(0)->textContent;
                $item['link'] = $item_el->getElementsByTagName('link')->item(0)->textContent;
                $item['date'] = strtotime($item_el->getElementsByTagName('date')->item(0)->textContent);
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
