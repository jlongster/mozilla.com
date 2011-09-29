<?php

require_once dirname(__FILE__) . '/FeedCache.php';

/**
 * Caches a list of feeds on cron
 *
 * The feeds to cache are defined in 'cron-config.ini'. See
 * 'cron-config.ini.dist' for an example configuration.
 *
 * @package   MozillaCom
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2011 Mozilla Foundation, 2011 silverorange
 * @license   http://www.mozilla.org/MPL/MPL-1.1.txt Mozilla Public License
 */
class FeedCacheCron
{
    /**
     * The file containing the configuration for this cron script
     *
     * @var string
     */
    protected $configFilename = '';

    /**
     * The parsed configuration for this cron script
     *
     * @var array
     */
    protected $config = array();

    /**
     * Whether or not to display output
     *
     * @var boolean
     */
    protected $verbose = false;

    /**
     * Creates a new cache cron script
     *
     * @param string $configFilename the file containing the configuration for
     *                               this cron script
     */
    public function __construct($configFilename)
    {
        $this->configFilename = $configFilename;
    }

    /**
     * Sets whether or not to display text output
     *
     * Text output is off by default. Errors are always displayed.
     *
     * @param boolean $verbose true to show output, false to hide output.
     *
     * @return FeedCacheCron this object for fluent interface.
     */
    public function setVerbose($verbose)
    {
        $this->verbose = ($verbose) ? true : false;
        return $this;
    }

    /**
     * Runs this cron caching script
     *
     * This causes the feeds defined in the configuration to be downloaded and
     * cached.
     */
    public function run()
    {
        $this->loadConfig();

        foreach ($this->config as $name => $config) {
            $this->cacheFeed($name, $config);
        }
    }

    /**
     * Caches a single feed
     *
     * @param string $name  the name of the feed. This must be the class name of
     *                      the feed class.
     * @param array $config the configuration options for the feed.
     *
     * @return void
     */
    protected function cacheFeed($name, $config)
    {
        $this->text("Caching {$name} feed:\n");
        // if class doesn't exist, try to load the class definition
        if (!class_exists($name)) {
            $filename = dirname(__FILE__) . '/' . $name . '.php';

            if (!file_exists($filename)) {
                $this->error("Feed class file '{$filename}' does not exist.\n");
            }

            if (!is_readable($filename)) {
                $this->error(
                    "Feed class file '{$filename}' is not readable.\n"
                );
            }

            include_once $filename;

            $this->text("=> class file loaded\n");
        }

        // make sure class exists after loading class definition
        if (!class_exists($name)) {
            $this->error("Feed class '{$name}' not found.\n");
        }

        $this->text("=> class definition exists\n");

        $key = 'cache-cron-'.$name;

        $lifetime = (isset($config['lifetime'])) ? $config['lifetime'] : 450;

        $shortCache = new FeedCache();
        $shortCache->setLifetime($lifetime);

        // check if cache is expired
        if ($shortCache->get($key) === false) {

            $this->text("=> cron cache is expired, refreshing\n");

            // make item cache never expire
            $longCache = new FeedCache();
            $longCache->setLifetime(0);

            $feed = new $name();
            $feed->setCache($longCache);

            // cache items
            $items = (isset($config['items'])) ? $config['items'] : 1;
            $feed->getItems($items);

            $this->text(
                sprintf(
                    "=> cached %s items\n",
                    $items
                )
            );

            // set expiry time
            $shortCache->set($key, 'cached');

        } else {
            $this->text("=> cron cache is still valid\n");
        }

        $this->text("\n");
    }

    /**
     * Loads the configuration for this cron script
     *
     * @return void
     */
    protected function loadConfig()
    {
        $this->text("Loading config.\n");

        if (!file_exists($this->configFilename)) {
            $this->error(
                "Feed cache cron config '{$this->configFilename}' missing.\n"
            );
        }

        if (!is_readable($this->configFilename)) {
            $this->error(
                "Feed cache cron config '{$this->configFilename}' "
                . "not readable.\n"
            );
        }

        $this->config = parse_ini_file($this->configFilename, true);

        $this->text(
            sprintf(
                "Config loaded. There are %s feeds.\n\n",
                count($this->config)
            )
        );
    }

    /**
     * Displays text and exists with an error status
     *
     * @param string $text the text to display.
     *
     * @return void
     */
    protected function error($text)
    {
        echo $text;
        exit(1);
    }

    /**
     * Displays text if verbose mode is enabled
     *
     * @param string $text the text to display.
     *
     * @return void
     */
    protected function text($text)
    {
        if ($this->verbose) {
            echo $text;
        }
    }
}

?>
