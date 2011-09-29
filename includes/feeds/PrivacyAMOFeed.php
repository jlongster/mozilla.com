<?php

require_once dirname(__FILE__) . '/AbstractFeed.php';

/**
 * @package   MozillaCom
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2011 Mozilla Foundation, 2011 silverorange
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt Mozilla Public License
 */
class PrivacyAMOFeed extends AbstractFeed
{
    public function getItems($limit = 3)
    {
        $items = array();
        $xpath = $this->getDOMXPath($this->getURI());

        if ($xpath !== null) {
            $itemEls = $xpath->query('//item');
            $count   = 0;
            foreach ($itemEls as $itemEl) {

                $link = $xpath->evaluate('string(link/text())', $itemEl);
                $slug = basename(rtrim($link, '/'));

                $amoXPath = $this->getAMOXPath($slug);
                if ($amoXPath !== null && $amoXPath->query('/error')->length == 0) {

                    $item = array();

                    $item['link']    = $link;
                    $item['title']   = $amoXPath->evaluate('string(/addon/name/text())');
                    $item['icon']    = $amoXPath->evaluate('string(/addon/icon/text())');
                    $item['summary'] = $amoXPath->evaluate('string(/addon/summary/text())');

                    $items[] = $item;
                    $count++;

                    if ($count >= $limit) {
                        break;
                    }

                }
            }
        }

        return $items;
    }

    protected function getURI()
    {
        return 'https://addons.mozilla.org/en-US/firefox/extensions/privacy-security/format:rss?popular';
    }

    protected function getAMOXPath($slug)
    {
        $uri = sprintf(
            'https://services.addons.mozilla.org/en-US/firefox/api/1.3/addon/%s',
            $slug
        );

        return $this->getDOMXPath($uri);
    }
}

?>
