<?php

require_once $config['file_root'] . '/includes/Cache/Lite.php';

abstract class AbstractFeed
{
    protected $config;
    protected $lifetime = 450; // 7.5 mins, about half static cache time

    public function __construct(array $config = array())
    {
        if (count($config) === 0) {
            global $config;
        }

        $this->config = $config;
    }

    abstract protected function getURI();

    protected function registerNamespaces(DOMXPath $xpath)
    {
        $xpath->registerNamespace('atom', 'http://www.w3.org/2005/Atom');
    }

    protected function getCache()
    {
        return new Cache_Lite(
            array(
                'cacheDir' => rtrim($this->config['file_root'], '/') . '/cache/',
                'lifeTime' => $this->lifetime,
            )
        );
    }

    protected function getXML($uri)
    {
        $cache = $this->getCache();

        if (($xml = $cache->get($uri)) === false) {
            $xml = $this->downloadFeed($uri);
            if ($xml === false) {
                // try invalid cached version if it exists
                if (($xml = $cache->get($uri, 'default', true)) === false) {
                    $xml = null;
                }
            } else {
                $cache->save($xml, $uri);
            }
        }

        return $xml;
    }

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
