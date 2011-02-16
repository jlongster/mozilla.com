<?php
/**
 * There were a lot of functions in the mozilla-europe code that were just dropped in
 * the middle of files and classes.  I've eliminated what I could, but there are some
 * extras that need to go somewhere.  It's better to collect them in one spot then
 * have to grep for them later I guess.  --clouserw
 */


/**
 * If the string exists in the language cache, return it, otherwise return what was
 * given to us. The language cache is build in the l10n_moz class
 */

function ___($str, $clean=0)
{
    if ($clean == 0) {
        $foo = !empty($GLOBALS['__l10n_moz'][$str]) ? $GLOBALS['__l10n_moz'][$str] : $str;
    } else if ($clean == 1) {
        $foo = !empty($GLOBALS['__l10n_moz'][$str]) ? strip_tags($GLOBALS['__l10n_moz'][$str]) : $str;
    }

    return (str_replace (' & ', ' &amp; ', $foo));
}


/**
 * print localized string
 *
 */

function e__($str, $clean=0)
{
    echo ___($str, $clean);
}


/**
 * Checks if a string is localized returns true/false
 */

function c__($str)
{
    return (!empty($GLOBALS['__l10n_moz'][$str])) ? true : false;
}

/**
 * Checks if a string is localized and not identical, returns true/false
 */

function i__($str)
{
    if (!empty($GLOBALS['__l10n_moz'][$str]) AND $GLOBALS['__l10n_moz'][$str] != $str) {
         return true;
     } else {
         return false;
     }
}


function isUpToDate($product_localized, $product_en)
{
    if ($product_localized->getLang() == 'en')
    {
        return true;
    }

    $version = $product_localized->getVersion();
    $version_en = $product_en->getVersion();

    return strcasecmp($product_localized->getVersion(), $product_en->getVersion()) == 0;
}

function is_num($var)
{
    $len = strlen($var);

    for ($i = 0; $i < $len; $i++)
    {
        $code = ord($var[$i]);

        # all numeric chars
        # all op chars
        # space
        if ($code < 32 || $code > 57)
            return false;
    }

    return true;
}

function printPlatformDownloadLink($product)
{
    if ($product['en']->name == 'Camino') {
        $platform = 'macosx';
    }
    else {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (strstr($useragent, 'Win')) {
            $platform = 'win32';
        }
        else if (strstr($useragent, 'Linux')) {
            $platform = 'linux';
        }
        else if (strstr($useragent, 'Mac OS X')) {
            $platform = 'macosx';
        }
        else {
            return;
        }
    }

    if (!$product[LANG]->hasPlatformBinary($platform)) {
        $product['en']->printDownloadLink($platform, true, true);
    }
    else if (isUpToDate($product[LANG], $product['en'])) {
        $product[LANG]->printDownloadLink($platform, true, false);
    }
    else {
        $product['en']->printDownloadLink($platform, true, true);
        echo ', ';
        $product[LANG]->printDownloadLink($platform, true, true);
    }
    //echo ', ';
}

/**
 * Look up the language in our language name array and return the value
 *
 * @param string $lang language
 */
function getLangTitle($lang)
{
    // In the config - the html'ized names of our languages
    global $native_languages;

    if (array_key_exists($lang, $native_languages)) {
        return $native_languages[$lang];
    } else {
        return '';
    }

}

/**
 * Used when echoing out the language links in the footer. Will return a single
 * string, either an <a> or <span>
 *
 * @param $lang string language (eg. 'en-US')
 * @param $exclude_current_lang boolean if true, the current language (in LANG) will
 *          not have <a> tags, but instead <span>
 * @param $add_suffix boolean if true, will automatically append the current page to
 *          links. (eg. If they are on /products/index.html that will be appended to
 *          all links.)
 */
function createLangLink($lang, $exclude_current_lang=true, $add_suffix=true)
{
    global $config;

    $suffix = '';
    if ($add_suffix) {
        // Strip $config['directory_index'] from the URL, if present
        $suffix = (strstr($_SERVER['REDIRECT_URL'], $config['directory_index'])) ? dirname($_SERVER['REDIRECT_URL']) : $_SERVER['REDIRECT_URL'];
    }

    if ($exclude_current_lang) {
        if ($lang == LANG) {
            return "<span>{$lang}</span>";
        }
    }

    $link = "{$config['url_scheme']}://{$lang}.{$config['server_name']}/{$lang}{$suffix}";

    // Get our title - if we have it, put title="" around it.
    $title = getLangTitle($lang);
    $title = empty($title) ? '' : 'title="'.$title.'"';

    return '<a hreflang="' . $lang . '" ' . $title . ' href="' . $link .  '">' . $lang . '</a>';
}

/**
 * Generate a list of languages (useful for footer links)
 */
function getLangLinksList()
{
    // From the main config - this is all of the languages we support
    global $full_languages;

    // Generate our list
    $lang_list = implode("</dd>\n <dd>", array_map('createLangLink', $full_languages));

    return "\n<dd>{$lang_list}</dd>\n";

}


/**
 * Generate a list of languages (useful for footer links)
 */
function getLangLinksSelect()
{
    // From the main config - these are the languages we want in the dropdown
    global $language_select_list;

    $_select_string = '';

    foreach ($language_select_list as $lang => $fullname) {

        // Find our current language in the list, and make it the selected option.
        $_selected = ($lang == LANG) ? ' selected="selected"' : '';
        $_value    = 'value="'.$lang.'"';

        $_select_string .= "    <option {$_value}{$_selected}>{$fullname}</option>\n";

    }


    return "\n<select id=\"flang\" name=\"flang\" dir=\"ltr\" onchange=\"this.form.submit()\">{$_select_string}</select>\n";

}

/**
 * Builds a breadcrumb string.  If an href is empty, it's assumed that it is the last
 * in the line of breadcrumbs and is surrounded by a <span> instead of an <a> and is
 * not followed by a raquo
 *
 * @param array breadcrumb string in this format:
 *      array(
 *          'title' => 'href',
 *          'title' => 'href',
 *          ...
 *           )
 * @return string HTML that represents the breadcrumbs, eg:
 *
 */
function buildBreadcrumbString($breadcrumbs)
{
    if (!is_array($breadcrumbs)) {
        return '';
    }

    $_breadcrumb_link_string = '';

    foreach ($breadcrumbs as $title => $href) {
        if (empty($href)) {
            $_breadcrumb_link_string .= "<span>{$title}</span>";
        } else {
            $_breadcrumb_link_string .= "<a href=\"{$href}\">{$title}</a> &#187; ";
        }
    }

    return $_breadcrumb_link_string;
}

/**
 * This function was created to highlight the link on the nav menu when the user is
 * viewing a page underneath it.  It keys off the breadcrumbs array to figure out
 * where it is in the site.  This is called in the per-lang header.
 *
 * @param array dynamic top menu array in the form:
 *      array (
 *       'title' => array(
 *                       'list-id' => 'menu_title',
 *                       'href'    => 'http://www.mozilla.com/',
 *                       'submenu' => array( ... )
 *                       ),
 *          ...
 *       )
 *
 * @param array breadcrumb array, form is defined in comments for buildBreadcrumbString()
 * @return string HTML text representing the menu
 */
function buildDynamicTopMenuString($dynamic_top_menu, $breadcrumbs)
{
    ob_start();

    if (is_array($dynamic_top_menu) && !empty($dynamic_top_menu)) {
        $dynamic_top_menu['id'] = 'nav-main'; // top level must be nav-main
        echo "\n<!-- start #nav-main -->\n";
        echo "\n<div id='nav-main' role='navigation'>\n";
        echo buildDynamicTopMenuRecursive($dynamic_top_menu, $breadcrumbs);
        echo "\n</div>\n";
        echo "<!-- end #nav-main -->\n";
    }

    return ob_get_clean();
}

function buildDynamicTopMenuRecursive($menu, $breadcrumbs, $level = 0)
{
    $_padding = str_repeat('      ', $level);

    ob_start();

    // If it's not an array, we're going to skip all this.  Checks for the $breadcrumb
    // array is unnecessary since we're using array_key_exists()
    if (is_array($menu) && !empty($menu)) {
        $_ul_class = ($level == 0) ? ' class="first-of-type"' : '';

        echo "{$_padding}    <ul{$_ul_class}>\n";

        if (is_array($menu['items']) && !empty($menu['items'])) {
            foreach ($menu['items'] as $name => $attributes) {

                // Just in case it's empty, we don't want a bunch of id="" on the page
                $_li_id = empty($attributes['id']) ? '' : " id=\"{$attributes['id']}\"";
                $_li_class = ($level == 0) ? ' class=""' : ' class=""';

                echo "<li{$_li_id}{$_li_class}>";

                // If the key exists in the breadcrumbs we'll use it to determine if
                // we're on the page or not
                if (array_key_exists($name, $breadcrumbs)) {

                    // If it exists, but is empty, we're currently on that page.
                    if (empty($breadcrumbs[$name])) {
                        echo "<span class=\"current\">{$name}</span>";
                    } else {
                    // It exists, but isn't empty, we're beneath that page
                        echo "<a class=\"current\" href=\"{$attributes['href']}\">{$name}</a>";
                    }

                } else {
                    // It doesn't exist in the breadcrumbs.  Just put a normal link up
                    echo "<a href=\"{$attributes['href']}\">{$name}</a>";
                }

                if (array_key_exists('submenu', $attributes)) {
                    echo "\n", buildDynamicTopMenuRecursive($attributes['submenu'], $breadcrumbs, $level + 1), "{$_padding}      ";
                }

                echo "</li>";
            }
        }

        echo "</ul>\n";
    }

    return ob_get_clean();
}


/**
 * Generates a download box for Firefox in-product pages
 */

function secondaryDownloadBox($lang)
{
    ?>
    <script src="/js/download.old.js"></script>
    <script>
        <!--
        // Configure the Firefox download write script
        var gDownloadItemTemplate = " <li class=\"%CSS_CLASS%\"> <h3><?=$GLOBALS['__l10n_moz']['Get Firefox 3']?><\/h3><div>%VERSION% for %PLATFORM_NAME%<br \/> %LANGUAGE_NAME%&nbsp;(%FILE_SIZE%)<\/div><a onclick=\"javascript:do_download('%BOUNCER_URL%');\" href=\"%DOWNLOAD_URL%\" class=\"download-link download-firefox\"><span class=\"download-link-text\">Download Firefox<span class=\"free\"> - Free<\/span><\/span><\/a><\/li>";
        var gDownloadItemMacOS9 = "<a href=\"\">MacOS 9 and earlier are not supported<\/a>";
        var gDownloadItemOtherPlatform = "<a href=\"/<?=$lang?>/firefox/<?=LATEST_FIREFOX_VERSION?>/releasenotes/#contributedbuilds\">Free Download<\/a>"

        document.writeln("<ul class=\"download download-firefox " + gCssClass + " \">");
        writeDownloadItems("fx");
        document.writeln("<\/ul>");
        document.writeln("<div class=\"download-other\"><span class=\"other\">");
        document.writeln("<a href=\"\/<?=$lang?>\/firefox\/<?=LATEST_FIREFOX_VERSION?>\/releasenotes\/\">Release Notes<\/a>");
        document.writeln("| <a href=\"\/<?=$lang?>\/firefox\/all.html\">Other Systems and Languages<\/a>");
        document.writeln("<\/span><\/div>");
        //-->
    </script>
    <?
}


/**
 * Generates inline JavaScript for displaying a platform-specific screenshot
 * image
 *
 * A suitable noscript tag containing the default image tag (Vista) is also
 * returned.
 *
 * Also note, the utils.js script should be included in the document head for
 * the JavaScript generated by this function to work correctly.
 *
 * @param string  $filename  the original filename (Windows version).
 * @param string  $alt       the alt text.
 * @param integer $width     optional. The image width.
 * @param integer $height    optional. The image height.
 * @param string  $class     optional. CSS class to apply to the image.
 * @param array   $platforms optional. Array of extra platforms. Valid extra
 *                           platforms are: 'mac', 'linux' and 'xp'. By default,
 *                           the extra platform 'mac' is used. Vista is the
 *                           fallback platform for all images. If no extra
 *                           platforms are specified, a simple image tag is
 *                           displayed.
 *
 * @return string a piece of inline JavaScript that can be used to display a
 *                platform-specific screenshot for the given parameters.
 */
function buildPlatformImage($filename, $alt, $width = null, $height = null,
    $class = null, $platforms = array('mac'))
{
    $valid_platforms = array('mac', 'linux', 'xp');
    $platforms = array_intersect($valid_platforms, $platforms);

    // maps platforms to JavaScript boolean expressions
    $platform_conditional = array(
        'mac'     => 'gPlatform == PLATFORM_MACOSX',
        'linux'   => 'gPlatform == PLATFORM_LINUX',
        'xp'      => '!gPlatformVista',
    );

    $filename = minimizeEntities($filename);
    $filename = escapeForJavaScript($filename);

    $alt = minimizeEntities($alt);
    $alt = escapeForJavaScript($alt);
    $alt = str_replace('%', '%%', $alt);

    // build image tag template
    $image_template = '<img src="%s" alt="' . $alt .'"';
    if (is_int($width)) {
        $image_template.= ' width="' . $width . '"';
    }
    if (is_int($height)) {
        $image_template.= ' height="' . $height . '"';
    }
    if (is_string($class)) {
        $class = minimizeEntities($class);
        $class = escapeForJavaScript($class);
        $class = str_replace('%', '%%', $class);
        $image_template.= ' class="' . $class . '"';
    }
    $image_template.= ' />';

    // build platform-specific image tags
    $filename_exp = explode('.', $filename);
    $extension = array_pop($filename_exp);
    $base = implode('.', $filename_exp);
    foreach ($platforms as $platform) {
        $platform_filename = $base . '-' . $platform . '.' . $extension;
        $platform_image[$platform] =
            sprintf($image_template, $platform_filename);
    }

    $default_image = sprintf($image_template, $filename);

    ob_start();

    if (count($platforms) === 0) {
        echo $default_image;
    } else {
        echo '<script>// <![CDATA[', "\n";

        foreach ($platforms as $index => $platform) {
            if ($index == 0) {
                printf("if (%s) {\n\tdocument.write('%s');\n",
                    $platform_conditional[$platform],
                    $platform_image[$platform]);
            } else {
                printf("} else if (%s) {\n\tdocument.write('%s');\n",
                    $platform_conditional[$platform],
                    $platform_image[$platform]);
            }
        }

        printf("} else {\n\tdocument.write('%s');\n}\n",
            $default_image);

        echo '// ]]></script><noscript>',
            $default_image,
            "</noscript>";
    }

    return ob_get_clean();
}

/**
 * Converts a UTF-8 text string to have the minimal number of entities
 * necessary to output it as valid UTF-8 XHTML without ever double-escaping.
 *
 * The text is converted as follows:
 *
 * - any exisiting entities are decoded to their UTF-8 characaters
 * - the minimal number of characters necessary are then escaped as entities:
 *         ampersands (&) => &amp;
 *          less than (<) => &lt;
 *       greater than (>) => &gt;
 *       double quote (") => &quot;
 *
 * Code lifted with permission from SwatString (http://swat.silverorange.com).
 *
 * @param string $text the UTF-8 text string to convert.
 *
 * @return string the UTF-8 text string with minimal entities.
 */
function minimizeEntities($text)
{
    // decode any entities that might already exist
    $text = html_entity_decode($text, ENT_COMPAT, 'UTF-8');

    // encode all ampersands (&), less than (<), greater than (>),
    // and double quote (") characters as their XML entities
    $text = htmlspecialchars($text, ENT_COMPAT, 'UTF-8');

    return $text;
}

/**
 * Safely escapes a PHP string into a JavaScript string
 *
 * The following rules are applied to prevent XSS attacks:
 *
 * - JavaScript string escape characters in the PHP string are escaped.
 * - Quotation marks in the PHP string are escaped.
 * - Closing script tags in the PHP string are broken into separate
 *   JavaScript strings.
 * - Closing CDATA triads are broken into multiple JavaScript strings.
 *
 * Implementation taken with permission from SwatString
 * (http://swat.silverorange.com).
 *
 * @param string  $string the PHP string to escape as a JavaScript string.
 * @param string  $quotes the quotation mark character used for the string.
 *                        Defaults to single quotes.
 * @param boolean $cdata  whether or not to escape CDATA tridents. Defaults to
 *                        true.
 *
 * @return string the escaped JavaScript string. The escaped string is safe to
 *                include in inline JavaScript.
 */
function escapeForJavaScript($string, $quotes = "'", $cdata = true)
{
    // escape escape characters
    $string = str_replace('\\', '\\\\', $string);

    // escape quotes
    $string = str_replace($quotes, '\\'.$quotes, $string);

    // break closing script tags
    $string = preg_replace('/<\/(script)([^>]*)?>/ui',
        "</\\1' + '\\2>", $string);

    // escape CDATA closing triads (if specified)
    if ($cdata) {
        $string = str_replace(']]>', "' +\n//]]>\n']]>' +\n//<![CDATA[\n'",
            $string);
    }

    return $string;
}

/**
 * Outputs a secondary menu for the Firefox pages
 *
 * @param string  $current  The short-name of the current section
 *
 * @return string Returns an HTML menu.
 */
function buildFirefoxSubPageMenu($lang, $current = null)
{
    $firefox_menu = array(
        'features'      => array(
            'href'      => "/firefox/features/",
            'title'     => ___('Features')
        ),
        'underthehood'   => array(
            'href'      => "/firefox/underthehood/",
            'title'     => ___('Under the Hood')
        ),
        'security'      => array(
            'href'      => "/firefox/security/",
            'title'     => ___('Security')
        ),
        'customize' => array(
            'href'      => "/firefox/customize/",
            'title'     => ___('Customization')
        ),
        'organic'       => array(
            'href'      => "/firefox/organic/",
            'title'     => ___('100% Organic Software')
        ),
        'tips'          => array(
            'href'      => "/firefox/tips/",
            'title'     => ___('Tips &amp; Tricks')
        ),
        'videos'        => array(
            'href'      => "/firefox/video/",
            'title'     => ___('Videos')
        ),
        'connect'       => array(
            'href'      => '/firefox/connect/',
            'title'     => ___('Connect')
        )
    );

    ob_start();

    if (count($firefox_menu) > 0) {
        echo "<ul id=\"side-menu\">\n";

        // special case for menu header
        echo "\t<li class=\"first\"><h3>";

        if ($current == 'products') {
            echo "<span>" . ___('Products') . "</span>";
        } else {
            echo "<a href=\"/" . $lang . "/products/\">" . ___('Products') . "</a>";
        }

        echo " / ";

        if ($current == 'firefox') {
            echo "<span>" . ___('Firefox') . "</span>";
        } else {
            echo "<a href=\"/" . $lang . "/firefox/\">" . ___('Firefox') . "</a>";
        }

        echo "</h3></li>\n";

        foreach ($firefox_menu as $id => $item) {
            echo "\t<li>";

            if ($current == $id) {
                echo "<span>" . $item['title'] . "</span>";
            } else {
                echo "<a href=\"/" . $lang . $item['href'] . "\">";
                echo $item['title'];
                echo "</a>";
            }
            echo "</li>\n";
        }

        echo "</ul>\n";
    }

    return ob_get_clean();
}


/**
 * Outputs a secondary menu for the Firefox Beta pages
 *
 * @param string  $current  The short-name of the current section
 *
 * @return string Returns an HTML menu.
 */
function buildFirefoxBetaSubPageMenu($lang, $current = null)
{
    $firefox_menu = array(
        'features'      => array(
            'href'      => "/firefox/RC/features/",
            'title'     => ___('Features')
        ),
        'technology'    => array(
            'href'      => "/firefox/RC/technology/",
            'title'     => ___('Technology')
        ),
        'feedback'   => array(
            'href'      => "/firefox/RC/feedback/",
            'title'     => ___('Feedback')
        ),
        'privacy'   => array(
            'href'      => "/firefox/RC/feedbackprivacypolicy/",
            'title'     => ___('Feedback Privacy Policy')
        ),
        'faq'       => array(
            'href'      => "/firefox/RC/faq/",
            'title'     => ___('FAQ')
        ),
        'press-kit' => array(
            /* 'href'      => "/press/kit-4b.html", */
            'href'      => "/press/kits/",
            'title'     => ___('Press Kit')
        )
    );

    ob_start();

    if (count($firefox_menu) > 0) {
        echo "<ul id=\"side-menu\">\n";

        // special case for menu header
        echo "\t<li class=\"first\"><h3>";

        if ($current == 'products') {
            echo "<span>" . ___('Products') . "</span>";
        } else {
            echo "<a href=\"/" . $lang . "/products/\">" . ___('Products') . "</a>";
        }

        echo " / ";

        if ($current == 'beta') {
            echo "<span>" . ___('Firefox 4') . "<sup>" .  ___('RC') .  "</sup></span>";
        } else {
            echo "<a href=\"/" . $lang . "/firefox/RC/\">" . ___('Firefox 4') . "<sup>" .  ___('RC') . "</sup></a>";
        }

        echo "</h3></li>\n";

        foreach ($firefox_menu as $id => $item) {
            echo "\t<li>";

            if ($current == $id) {
                echo "<span>" . $item['title'] . "</span>";
            } else {
                echo "<a href=\"/" . $lang . $item['href'] . "\">";
                echo $item['title'];
                echo "</a>";
            }
            echo "</li>\n";
        }

        echo "</ul>\n";
    }

    return ob_get_clean();
}

/**
 * Outputs a secondary menu for the Firefox Beta pages
 *
 * @param string  $current  The short-name of the current section
 *
 * @return string Returns an HTML menu.
 */
function buildFirefoxMobileBetaSubPageMenu($lang, $current = null)
{
    $firefox_menu = array(
        'release_notes' => array(
            'href'      => '/mobile/4.0b3/releasenotes/index.html',
            'title'     => ___('Release Notes'),
        ),
        'features' => array(
            'href'      => "/mobile/beta/features/",
            'title'     => ___('Features')
        ),
        'faq' => array(
            'href'      => "/mobile/beta/faq/",
            'title'     => ___('FAQ')
        ),
        'feedback' => array(
            'href'      => "http://support.mozilla.com/kb/Mobile+Help+and+Tutorials",
            'title'     => ___('Support')
        ),
        'gomobile' => array(
            'href'      => "/mobile/beta/",
            'title'     => ___('Go Mobile')
        ),
    );

    ob_start();

    if (count($firefox_menu) > 0) {
        echo "<ul id=\"side-menu\">\n";

        // special case for menu header
        echo "\t<li class=\"first\"><h3>";

        if ($current == 'products') {
            echo "<span>" . ___('Products') . "</span>";
        } else {
            echo "<a href=\"/" . $lang . "/products/\">" . ___('Products') . "</a>";
        }

        echo " / ";

        if ($current == 'home') {
            echo "<span>" . ___('Firefox') . " <sup>" .  ___('Beta') .  "</sup></span>";
        } else {
            echo "<a href=\"/" . $lang . "/mobile/beta/\">" . ___('Firefox') . " <sup>" .  ___('Beta') . "</sup></a>";
        }

        echo "</h3></li>\n";

        foreach ($firefox_menu as $id => $item) {
            echo "\t<li>";

            if ($current == $id) {
                echo "<span>" . $item['title'] . "</span>";
            } else {
                if (strpos($item['href'], 'http') !== FALSE) {
                    $url = $item['href'];
                } else {
                    $url = "/{$lang}{$item['href']}";
                }
                echo "<a href=\"{$url}\">";
                echo $item['title'];
                echo "</a>";
            }
            echo "</li>\n";
        }

        echo "</ul>\n";
    }

    return ob_get_clean();
}

/**
 * Build a set of available postcard choices for /en-US/mobile/beta/gomobile
 *
 * Shared between the page hosting the postcard form, as well as the form
 * processor at includes/mobile-beta-send-postcard.php
 *
 * Describes images found at /img/mobile/beta/postcards/
 */
function buildFirefoxMobileBetaPostcardChoices($lang='en-US')
{
    return array(
        'starrysky' => array(
            'thumb'   => 'starrysky-thumb.png',
            'preview' => 'starrysky-mid.png',
            'full'    => 'starrysky-large.png'
        ),
        'browsing' => array(
            'thumb'   => 'browsing-thumb.png',
            'preview' => 'browsing-mid.png',
            'full'    => 'browsing-large.png'
        ),
        'android' => array(
            'thumb'   => 'android-thumb.png',
            'preview' => 'android-mid.png',
            'full'    => 'android-large.png'
        ),
        'mobile' => array(
            'thumb'   => 'mobile-thumb.png',
            'preview' => 'mobile-mid.png',
            'full'    => 'mobile-large.png'
        ),
    );
}

/**
 * Outputs a secondary menu for Fennec pages
 *
 * @param string $currentthe short-name of the current section
 *
 * @return string Returns an HTML menu.
 */
function buildMobileSubPageMenu($lang, $current = null)
{

    require_once 'product-details/mobileDetails.class.php';

    $menu = array(
        'download'      => array(
            'href'      => "/mobile/download/",
            'title'     => ___('Download')
        ),
        'features'      => array(
            'href'      => "/mobile/features/",
            'title'     => ___('Features')
        ),
        'customize'     => array(
            'external'  => true,
            'href'      => "https://addons.mozilla.org/".$lang."/mobile/?browse=featured",
            'title'     => ___('Customize with Add-ons'),
        ),
        'sync'          => array(
            'href'      => "/firefox/sync/",
            'title'     => ___('Sync Your Desktop &amp; Mobile')
        ),
        'developers'    => array(
            'external'  => true,
            'href'      => "https://developer.mozilla.org/".$lang."/mobile",
            'title'     => ___('Develop for Mobile')
        ),
        'getinvolved'   => array(
            'href'      => "/mobile/getinvolved/",
            'title'     => ___('Get Involved')
        ),
        'faq'           => array(
            'href'      => "/mobile/faq/",
            'title'     => ___('FAQ')
        ),
        'blog'          => array(
            'external'  => true,
            'href'      => "https://blog.mozilla.com/mobile/",
            'title'     => ___('Mobile Blog')
        )
    );
    if ($lang != 'en-US') {
        unset($menu['maemo']);
    }

    ob_start();

    if (count($menu) > 0) {
        echo "<ul id=\"side-menu\">\n";

        // special case for menu header
        echo "\t<li class=\"first\"><h3>";

        if ($current == 'products') {
            echo "<span>" . ___('Products') . "</span>";
        } else {
            echo "<a href=\"/" . $lang . "/products/\">" . ___('Products') . "</a>";
        }

        echo " / ";

        if ($current == 'mobile') {
            echo "<span>" . ___('Mobile') . "</span>";
        } else {
            echo "<a href=\"/" . $lang . "/mobile/\">" . ___('Mobile') . "</a>";
        }

        echo "</h3></li>\n";

        foreach ($menu as $id => $item) {
            echo "\t<li>";

            if ($current == $id) {
                echo "<span>" . $item['title'] . "</span>";
            } else {
                if (isset($item['external']) && $item['external'] == true) {
                    echo "<a href=\"" . $item['href'] . "\">";
                } else {
                    echo "<a href=\"/" . $lang . $item['href'] . "\">";
                }
                echo $item['title'];
                echo "</a>";
            }
            echo "</li>\n";
        }

        echo "</ul>\n";
    }

    return ob_get_clean();
}

/**
 * Outputs a secondary menu for Firefox Home for iPhone pages
 *
 * @param string $currentthe short-name of the current section
 * @return string Returns an HTML menu.
 */
function buildHomeForiPhoneSubPageMenu($lang, $current = null)
{

    require_once 'product-details/mobileDetails.class.php';

    $menu = array(
        'home'          => array(
            'href'      => "/mobile/home/",
            'title'     => ___('Firefox Home for iPhone')
        ),
        'releasenotes'  => array(
            'href'      => "/mobile/home/1.0/releasenotes/",
            'title'     => ___('Release Notes')
        ),
        'faq'           => array(
            'href'      => "/mobile/home/faq/",
            'title'     => ___('FAQ')
        ),
        'survey'        => array(
            'href'      => 'http://www.surveygizmo.com/s/314627/tell-us-what-you-think-firefox-home-for-the-iphone',
            'title'     => ___('Tell us what you think'),
            'external'  => true
        ),
    );

    ob_start();

    if (count($menu) > 0) {
        echo "<ul id=\"side-menu\">\n";

        // special case for menu header
        echo "\t<li class=\"first\"><h3>";
        echo "<a href=\"/" . $lang . "/products/\">" . ___('Products') . "</a>";
        echo " / ";
        echo "<a href=\"/" . $lang . "/mobile/\">" . ___('Mobile') . "</a>";
        echo "</h3></li>\n";

        foreach ($menu as $id => $item) {
            // Get Involved link
            if ($id == 'survey') {
                echo '<li class="getinvolved"><h3>'.___('Get Involved').'</h3></li>';
            }

            echo "\t<li>";

            if ($current == $id) {
                echo "<span>" . $item['title'] . "</span>";
            } else {
                if (isset($item['external']) && $item['external'] == true) {
                    echo "<a href=\"" . $item['href'] . "\">";
                } else {
                    echo "<a href=\"/" . $lang . $item['href'] . "\">";
                }
                echo $item['title'];
                echo "</a>";
            }
            echo "</li>\n";
        }

        echo "</ul>\n";
    }

    return ob_get_clean();
}
/**
 * Gets the Firefox version number from the location of the PHP source file
 *
 * Files are split into different directories for each release of Firefox.
 *
 * @return string the version number or null if the version number could
 *                not be retrieved from the source file location.
 */
function getVersionBySelf()
{
    $_matches    = array();
    $_expression = '/
        \d             # major version number
        (?:\.\d+){1,3} # minor, micro, etc
        (?:[ab]\d+)?   # alpha, beta releases
        (?:pre)?       # pre-release
    /x';

    preg_match($_expression, $_SERVER['REQUEST_URI'], $_matches);

    return (count($_matches) === 0) ? null : $_matches[0];
}

/**
 * Gets whether or not a version number is valid based on whether or not
 * release notes exist for the version.
 *
 * The version is valid if there are releasenotes, either in the current\
 * language or in English.
 *
 * @param string $version   the version number to check.
 * @param string $file_root the root location of the release notes.
 * @param string $lang      the current language.
 *
 * @return boolean true if the version is valid, false otherwise.
 */
function isValidVersionByReleaseNotes($version, $file_root, $lang)
{
    return ($version !== null
        && (
               file_exists("{$file_root}/{$lang}/firefox/{$version}/releasenotes/index.html")
            || file_exists("{$file_root}/en-US/firefox/{$version}/releasenotes/index.html")
        )
    );
}

/**
 * insertQuarterlySurvey()
 * author: Pascal Chevrel
 * Date: 2009-05-20
 *
 * inserts the quarterly survey in the whatsnew page into a set of locales
 * $localesForSurvey contains the locales that have the survey
 * $lang: the locale we want, fallback to en-GB
 * $active: 0 = no survey, 1 = survey running.
 * $version: Firefox version on which to display the survey
 * returns: a chunk of localized html
 *
 * depends on getVersionBySelf();
 */

function insertQuarterlySurvey( $lang='en-GB', $active=array('') )
{
    $localesForSurvey = array(
        'de'    => 'http://www.surveygizmo.com/s/215020/wkz80',
        'en-GB' => 'http://www.surveygizmo.com/s/215015/ovye0',
        'es-ES' => 'http://www.surveygizmo.com/s/215016/j7cth',
        'fr'    => 'http://www.surveygizmo.com/s/215018/2lo73',
        'it'    => 'http://www.surveygizmo.com/s/215023/5yyqq',
        'pl'    => 'http://www.surveygizmo.com/s/215030/z1kiv',
        'pt-BR' => 'http://www.surveygizmo.com/s/215031/e2iq3',
        'zh-CN' => 'http://www.surveygizmo.com/s/215032/d4ob9',
        'zh-TW' => 'http://www.surveygizmo.com/s/215017/vnm86'
    );

    $version = getVersionBySelf();

    if(in_array($lang, array_keys($localesForSurvey)) AND in_array($version, $active))
    {

        global $config;
        ob_start();
            echo "\n<!--  quarterly survey below  -->\n";
            @include $config['file_root']."/$lang/includes/l10n/quarterlySurvey.inc.php";

$surveyJS = <<<SURVEY
    <script>
    // Surveys for 50% of people; Bugs 449417 & 466849
    $(document).ready( function hideSurvey() {
        var survey = document.getElementById('survey');
        var addons = document.getElementById('addons');
        if (survey) {
            var rand = Math.random();
            if (rand < 0.50) {
                if (addons) {
                    $(addons).addClass('hide');
                }
                $(survey).removeClass('hide');
            }
        }
    });
    // ]]>
    </script>
SURVEY;
            echo $surveyJS;
            $buffer = ob_get_contents();
            ob_end_clean();
    }

    return (isset($buffer)) ? $buffer : false;
}

function urlHasLang($url, $lang) {
    $url = $url[0] == '/' ? substr($url, 1) : $url;
    $split = explode('/', $url);
    return strtolower($split[0]) == strtolower($lang);
}

/* propertiesToArray()
 *
 * This function parses a JavaScript  properties file
 * and converts it to a PHP array.
 *
 * $file = path to properties file
 */
function propertiesToArray($file) {
    if (!is_file($file)) return array();

    $source = file($file);

    // we parse the $source array and remove white space
    foreach ($source as $value)
    {
        $temp = explode("=", $value);
        $finalArray[trim($temp[0])] = trim($temp[1]);
    }

    return $finalArray;
}



/* hidePartialLocaleJS($release)
 *
 * This function fixes sownload.olf.js by allowing cancelling
 * download boxes for locales with partial OS support
 *
 * $release = /ex : LATEST_FIREFOX_DEVEL_VERSION
 */



function hidePartialLocaleJS($release) {
    global $firefoxDetails;
    $builds = $firefoxDetails->primary_builds + $firefoxDetails->beta_builds;
    $_platforms  = array('Windows' => 1, 'Linux' => 2, 'OS X' => 3);

    echo '<script>'."\n";
    echo '//<![CDATA['."\n";

    foreach ($_platforms as $os_name => $os_name_js) {
        echo "if (gPlatform == $os_name_js) {\n";

            foreach($builds as $var => $temp) {
                $val = isset($temp[$release][$os_name]['unavailable']) ? true : false;
                if($val == true) {
                    $locale_array = explode('-',strtolower($var));
                    $_region_code = isset($locale_array[1]) ? $locale_array[1] : '-';
                    echo "  gLanguages['".$var."']['".$_region_code."']['fxbeta'] = null;\n";
                }
            }
        echo "}\n";
    }

    echo '//]]>'."\n";
    echo '</script>'."\n";
}
?>
