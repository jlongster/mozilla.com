<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/**
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 **/

return array(
    'js' => array(
        '//js/util.js',
        '//js/jquery/jquery.min.js',
        '//js/nav-main.js',
        '//js/newsletter-form.js'
    ),
    'js_utils' => array(
      '//js/util.js',
    ),
    'js_stats' => array(
        '//js/webtrends.js' // WebTrends
    ),
    'css' => array(
        '//style/covehead/template.css',
        '//style/covehead/content.css',
    ),
    'css_firstrun' => array(
        '//style/firefox/3.6/firstrun-page.css'
    ),
    'css_home' => array(
        '//style/covehead/home.css',
        '//style/covehead/video-player.css'
    ),
    'css_firstrun4' => array(
        '//style/firefox/4/firstrun-page.css'
    ),
    'css_whatsnew4' => array(
        '//style/firefox/4/whatsnew-page.css'
    ),
    'css_firstrun5' => array(
        '//style/firefox/5/firstrun-page.css'
    ),
    'css_whatsnew5' => array(
        '//style/firefox/5/whatsnew-page.css'
    ),
    'css_whatsnew6' => array(
        '//style/firefox/6/whatsnew-page.css'
    ),
    'css_firstrun6' => array(
        '//style/firefox/6/firstrun-page.css'
    ),
    'css_aurora' => array(
        '//style/firefox/aurora/firstrun-page.css'
    ),
    'js_portal_header' => array(
        '//js/util.js',
    ),
    'js_whatsnew4' => array(
        '//js/jquery/jquery.min.js',
        '//js/detect-flash.js'
    ),
    'js_whatsnew5' => array(
        '//js/jquery/jquery.min.js',
        '//js/detect-flash.js'
    ),
    'js_portal_footer' => array(
        '//js/jquery/jquery.min.js',
        '//js/newsletter-form.js',
        '//js/mozilla-input-placeholder.js'
    ),
    'detect_flash' => array(
        '//js/detect-flash.js'
    )
);
