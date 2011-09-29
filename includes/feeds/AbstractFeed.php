<?php

require_once dirname(__FILE__) . '/FeedCache.php';

/**
 * @package   MozillaCom
 * @author    Michael Gauthier <mike@silverorange.com>
 * @author    James Long
 * @copyright 2011 Mozilla Foundation, 2011 silverorange
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt Mozilla Public License
 */
abstract class AbstractFeed
{
    /**
     * Mozilla.com website config array
     *
     * @var array
     */
    protected $config = array();

    /**
     * Cache implementation
     *
     * @var FeedCache
     */
    protected $cache = null;

    /**
     * Creates a new feed reader
     *
     * @param array $config optional. The Mozilla.com website configuration. If
     *                      not specified, the global config is used.
     */
    public function __construct(array $config = array())
    {
        if (count($config) === 0) {
            global $config;
        }

        $this->config = $config;

        // default cache implementation
        $cache = new FeedCache();
        $cache->setLifetime(450);
        $this->setCache($cache);
    }

    /**
     * Sets the cache implementation to use for this feed
     *
     * @param FeedCache $cache the cache implementation to use.
     *
     * @return AbstractFeed this feed for fluent interface.
     */
    public function setCache(FeedCache $cache)
    {
        $this->cache = $cache;
        return $this;
    }


    /**
     * Gets the source URI of this feed
     *
     * Subclasses should set the feed URI here.
     *
     * @return string the source URI of this feed
     */
    abstract protected function getURI();

    /**
     * Registers the default namespaces used by Atom and RSS feeds with the
     * XPath object
     *
     * @return void
     */
    protected function registerNamespaces(DOMXPath $xpath)
    {
        $xpath->registerNamespace('atom', 'http://www.w3.org/2005/Atom');
    }

    /**
     * Gets the raw XML of this feed
     *
     * If the feed is cached, the cached XML is returned, otherwise the content
     * is downloaded.
     *
     * @return string
     */
    protected function getXML($uri)
    {
        $xml = false;

        // no shared cached version, try the local cache
        if ($xml === false) {
            if (($xml = $this->cache->get($uri)) === false) {
                $xml = $this->downloadFeed($uri);
                if ($xml === false) {
                    // try invalid cached version if it exists
                    if (($xml = $this->cache->get($uri, true)) === false) {
                        $xml = null;
                    }
                } else {
                    // save cached version
                    $this->cache->set($uri, $xml);
                }
            }
        }

        return $xml;
    }

    /**
     * Gets an XPath object that can query the XML document for this feed
     *
     * @return DOMXPath
     */
    protected function getDOMXPath($uri)
    {
        $xpath    = null;
        $document = $this->getDOMDocument($uri);

        if ($document !== null) {
            $xpath = new DOMXPath($document);
            $this->registerNamespaces($xpath);
        }

        return $xpath;
    }

    /**
     * Gets a DOM Document for this feed
     *
     * @return DOMDocument
     */
    protected function getDOMDocument($uri)
    {
        $document = new DOMDocument();

        $xml = $this->getXML($uri);
        if ($xml != '') {
            $document = new DOMDocument();
            $document->loadXML($xml);
        }

        return $document;
    }

    /**
     * Downloads this feed from the feed URI
     *
     * @return string the downloaded content.
     *
     * @see AbstractFeed::getURI()
     */
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
