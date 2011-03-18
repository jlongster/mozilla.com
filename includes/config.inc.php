<?php
/**
 * Mozilla.com configuation file.  This needs to be setup before the site will work. 
 * There are other requirements as well.  Read the README.
 *
 * All language config (what languages are available) are in:
 *      /includes/langconfig.inc.php
 */


/**
 * Holds the server name (domain name).  Locales will be prepended to this.  We can't
 * use $_SERVER['SERVER_NAME'] because they might already have prepended the locale.
 *
 * Example:
 *  khan.mozilla.org
 *      or
 *  mozilla.org
 */
$config['server_name'] = 'mozilla.james.local';


/**
 * file path to the root directory.  We're defining it here instead of using relative
 * paths and code like "dirname(__FILE__)" just for the speed.  If we don't need to
 * do a bunch of repetitive code, there's no need to. No trailing slash.
 *
 * Example:
 *  /data/khan.mozilla.org
 *      or
 *  /var/www
 */
$config['file_root'] = '/Users/james/projects/mozilla/svn.mozilla.com/tags/stage';


/**
 * The default language to use when all our language parsing/guessing fails.
 * Example:
 *  en-US
 *      or
 *  de
 */
$config['default_lang'] = 'en-US';

/**
 * SMS settings: Ask dd@mozilla.com for these.
 */

$config['sms_username'] = '';
$config['sms_password'] = '';

/**
 * SMS Kill Switch
 * Set to true to disable SMS forms
 * Example:
 * $config['sms_disabled'] = true;
 */

/**
 * Holds the url scheme (what is before the colon).  This is now set automatically -
 * no need to change this variable.
 *
 * Example:
 *  http
 *      or
 *  https
 */
if (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] == 'on') {
    $config['url_scheme'] = 'https';
} else {
    $config['url_scheme'] = 'http';
}


/**
 * Short answer: Don't mess with this.
 *
 * This is the name of the index file (DirectoryIndex in the apache config).  This variable is 
 * needed for detecting 404s, as illustrated in the following scenario:
 * 
 * A user goes to http://xx-YY.www.mozilla.com/, where xx-YY is going to give a 404.
 * That's actually picked up by apache and rerouted to /includes/prefetch.php.
 *
 * The prefetch script is going to look if the page exists in the
 * $config['default_lang'] directory before it gives a 404.  However, when a user
 * doesn't specify the file, it comes through as '/' - that's not gonna work for php,
 * so this is the name of the file.  Right now we're using index.html because that is
 * what the old site used.  If we ever completely rewrite and use .php extensions,
 * change this (that is, unlikely...).
 */
$config['directory_index'] = 'index.html';

/**
 * This is the URL of the firstrun form processor.  The form on en-US firstrun
 * pages will point here for a period of time in order to do a test-run for
 * product mgmt.
 */
$config['firstrun_survey_url'] = '';

/**
 * This is the URL of the university form processor. (bug 395429)
 */
$config['university_survey_url'] = '';

/**
 * Usage statistics are collected via WebTrends (bug 556384). Tracking codes
 * are in /includes/js_stats.inc.php .
 */

/**
 * If you're going to support searching, fill this in with the URL of the 
 * search source. (XML)
 *
 * Example:
 *  http://sm-devnutch01.mozilla.org:8080/opensearch
 */
$config['nutch_url'] = '';

/**
 * What server should nutch restrict search results to?  For production, this should be
 * the same as $config['server_name'].  For testing, you can make this the production site
 * so results will show up.
 *
 * Example:
 *  $config['server_name']
 *      or
 *  mozilla.com
 */
$config['nutch_server_name'] = $config['server_name'];

/**
 * What is the Google Maps API key for this server?  Used on, for example, en-US/about/contact.html
 *
 * Example:
 *  ABQIAAAAJxF9iCN32uVbCYVf9GYBZRR47t7R1oHohFx0gayQC_gitAXJnxSphNGrLLbOUsWrFdLjZtYlFsa2cg
 */
$config['gmap_api_key'] = '';

/**
 * Optional static prefix URL for offloading of /img and /style. No trailing slash.
 *
 * Example:
 *  http://images.mozilla.com
 */
$config['static_prefix'] = '';

/**
 * This is the URL of the Violating Website Report form submit handler, bug 457023
 *
 * Example:
 *  http://survey.mozilla.com/fraud_report.php
 */
$config['fraud_report_handler'] = '';

/**
 * Funnelcake suffix.  If a Funnelcake run is happening set this variable to the
 * appropriate suffix, otherwise leave blank.  This only affects:
 *      /en-US/
 *      /en-US/firefox/
 *      /en-US/firefox/all.html
 *
 * Example:
 *  -01
 */
$config['funnelcake_suffix'] = '';

/**
 * Recaptcha API keys 
 *
 * Example:
 * $config['recaptcha_pub_key'] = '6Le9SAkAAAAAANBr74mJ3FJVOhJ6WKP3SB9jK6xp';
 * $config['recaptcha_priv_key'] = 'yadayadayadayadayadayadadyadyyfa3@#ayayd';
 */
$config['recaptcha_pub_key'] = '6Le9SAkAAAAAANBr74mJ3FJVOhJ6WKP3SB9jK6xp';

/**
 * What PFS2 Server should we use?
 *
 * Examples: http://pfs2.stage.mozilla.com/
 *           http://pfs.mozilla.com/v2/
 */
$config['pfs_endpoint'] = 'http://pfs2.stage.mozilla.com/';

/**
 * Memcache config for Minify script
 * Remove all entries to turn off or ignore altogether, script will fallback to 
 * file based cache if no memcache servers are available
 */
$config['memcache'] = array(
    'localhost' => array(
        'port' => '11211',
        'timeout' => '1',
    )
);

/**
 * PHP debug options
 * http://php.net/manual/en/errorfunc.configuration.php
 *
 * ini_set('display_errors', 1);
 * ini_set('display_startup_errors', 1);
 * ini_set('error_reporting', E_ALL);
 */

 /** 
  * PHP APC options
  * http://www.php.net/manual/en/apc.configuration.php
  * 
  * ini_set('apc.enabled', 0);
  */

/**
 * Basket API keys
 * http://github.com/abuchanan/basket
 * Example:
 *   For stage/dev sites:
 *   $config['basket_url'] = 'http://basket-stage.mozilla.com';
 *
 *   For production sites:
 *   $config['basket_url'] = 'http://basket.mozilla.com';
 */

/**
 * Responsys Form ID
 * Uncomment this to use the TEST_CONTACTS_LIST in Responsys.
 * Otherwise, your data will submit to the CONTACTS_LIST.
 * $config['responsys_id'] = 'X0Gzc2X%3DUQpglLjHJlTQTtQ1vQ2rQ0bQQzgQvQy8KVwjpnpgHlpgneHmgJoXX0Gzc2X%3DUQpglLjHJlTQTtQ1vQ2rQ0aQQGQvQwPD';
 */

/**
 * SMTP server config, initially for /en-US/mobile/beta/gomobile/ postcard mailer.
 *
 * If left unconfigured, includes/mobile-beta-send-postcard.php will default to
 * using PHP built-in mail() function.
$config['smtp_host'] = 'ssl://some.smtp.server.com';
$config['smtp_port'] = 465;
$config['smtp_auth'] = true;
$config['smtp_username'] = 'SMTP USER';
$config['smtp_password'] = 'SMTP PASSWORD';
 */
?>
