<?php

require_once dirname(__FILE__) . '/../Cache/Lite.php';

/**
 * Caches feed contents
 *
 * @package   MozillaCom
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2011 Mozilla Foundation, 2011 silverorange
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt Mozilla Public License
 */
class FeedCache
{
    /**
     * Mozilla.com website config array
     *
     * @var array
     */
    protected $config;

    /**
     * Cache lifetime in seconds
     *
     * @var integer
     */
    protected $lifetime = 450; // 7.5 mins, about half static cache time

    /**
     * @var Cache_Lite
     */
    protected $cacheLite;

    /**
     * @var Memcache
     */
    protected $memcache;

    /**
     * Creates a new feed cache
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
    }

    /**
     * Sets the lifetime of this cache
     *
     * @param integer $lifetime. Use 0 to set infinite lifetime.
     *
     * @return FeedCache this cache for fluent interface.
     */
    public function setLifetime($lifetime)
    {
        $this->lifetime = intval($lifetime);
        return $this;
    }

    /**
     * Caches a value
     *
     * @param string $key   the name of the value to set.
     * @param string $value the value to set.
     *
     * @return FeedCache the current cache object for fluent interface.
     */
    public function set($key, $value)
    {
        $this->getCacheLite()->save($value, $key);

        $memcache = $this->getMemcache();
        if ($memcache instanceof Memcache) {
            $memcache->set($key, $value, 0, $this->lifetime);
        }

        return $this;
    }

    /**
     * Gets a cached value
     *
     * @param string  $key     the name of value to retrieve.
     * @param boolean $invalid optional. If true, expired cache values that
     *                         exist may be returned if no valid cached value
     *                         exists.
     *
     * @return string|boolean the cached value or false if no cached value
     *                        exists.
     */
    public function get($key, $invalid = false)
    {
        $value = false;

        $memcache = $this->getMemcache();
        if ($memcache instanceof Memcache) {
            $value = $this->memcache->get($key);
        }

        if ($value === false) {
            $value = $this->getCacheLite()->get($key);
        }

        if ($value === false && $invalid) {
            $value = $this->getCacheLite()->get($key, 'default', true);
        }

        return $value;
    }

    /**
     * Gets the cache-lite object for this cache
     *
     * @return Cache_Lite
     */
    protected function getCacheLite()
    {
        if (!($this->cacheLite instanceof Cache_Lite)) {
            $this->cacheLite = new Cache_Lite(
                array(
                    'cacheDir' => dirname(__FILE__) . '/../../cache/',
                    'lifeTime' => $this->lifetime,
                )
            );
        }

        return $this->cacheLite;
    }

    /**
     * Gets a mamcache object if memcache is available and memcache servers are
     * set in the config
     *
     * @return Memcache the memcache object or null if memcache is not
     *                  available.
     */
    protected function getMemcache()
    {
        if (   extension_loaded('memcache')
            && isset($this->config['memcache'])
            && !($this->memcache instanceof Memcache)
        ) {
            $memcache = new Memcache();

            $connected = false;

            // try to connect to all servers in the config
            foreach ($this->config['memcache'] as $host => $options) {
                $result = $memcache->addServer(
                    $host,
                    $options['port'],
                    true, // persistent
                    1, // weight
                    $options['timeout']
                );

                if ($result) {
                    $connected = true;
                }
            }

            // make sure we connected to a memcache server
            if ($connected) {
                $this->memcache = $memcache;
            }
        }

        return $this->memcache;
    }
}

?>
